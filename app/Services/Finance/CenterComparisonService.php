<?php

namespace App\Services\Finance;

use App\Models\Center;
use App\Models\CenterMonthlyCollection;
use App\Models\Group;
use Illuminate\Support\Collection;

class CenterComparisonService
{
    /**
     * Get status based on collection rate (state/etat).
     *
     * @param float $collectionRate
     * @return string
     */
    public function getStatus(float $collectionRate): string
    {
        if ($collectionRate >= 0.95) {
            return 'Normal';
        } elseif ($collectionRate >= 0.85) {
            return 'À surveiller';
        } else {
            return 'Problème';
        }
    }

    /**
     * Compare monthly revenues within a selected year.
     * Returns rows grouped by (center_id, month).
     * OPTIMIZED: No N+1 queries - fetches all data in 3 queries.
     *
     * @param int $year
     * @param int|null $centerId
     * @return Collection
     */
    public function compareMonthlyYear(int $year, ?int $centerId = null): Collection
    {
        // Get all centers for this year
        $centers = Center::query()
            ->when($centerId !== null, fn($q) => $q->where('id', $centerId))
            ->orderBy('name')
            ->get();

        if ($centers->isEmpty()) {
            return collect();
        }

        // Query 1: Get all expected revenue (grouped by center_id, month) for all centers in one query
        $expectedData = Group::query()
            ->selectRaw('center_id, month, SUM(students_end_count * price_per_student) as total_expected, SUM(students_end_count) as total_students')
            ->where('year', $year)
            ->whereIn('center_id', $centers->pluck('id'))
            ->groupBy('center_id', 'month')
            ->get()
            ->keyBy(fn($row) => "{$row->center_id}_{$row->month}");

        // Query 2: Get all collected revenue (grouped by center_id, month) for all centers in one query
        $collectedData = CenterMonthlyCollection::query()
            ->selectRaw('center_id, month, SUM(cash_amount + tpe_amount + bank_transfer_amount + cheque_amount) as total_collected')
            ->where('year', $year)
            ->whereIn('center_id', $centers->pluck('id'))
            ->groupBy('center_id', 'month')
            ->get()
            ->keyBy(fn($row) => "{$row->center_id}_{$row->month}");

        // Build results in memory (no more queries)
        $results = collect();
        $allMonths = range(1, 12);

        foreach ($centers as $center) {
            foreach ($allMonths as $month) {
                $key = "{$center->id}_{$month}";

                $expectedRevenue = (float) ($expectedData[$key]->total_expected ?? 0);
                $totalStudents = (int) ($expectedData[$key]->total_students ?? 0);
                $collectedRevenue = (float) ($collectedData[$key]->total_collected ?? 0);

                $variance = $collectedRevenue - $expectedRevenue;
                $collectionRate = $expectedRevenue > 0 ? $collectedRevenue / $expectedRevenue : 0;

                // Only include if there's data
                if ($expectedRevenue > 0 || $collectedRevenue > 0) {
                    $results->push([
                        'center_id' => $center->id,
                        'center_name' => $center->name,
                        'city' => $center->city,
                        'month' => $month,
                        'year' => $year,
                        'expected_revenue' => $expectedRevenue,
                        'total_students' => $totalStudents,
                        'collected_revenue' => $collectedRevenue,
                        'variance' => $variance,
                        'collection_rate' => $collectionRate,
                        'etat' => $this->getStatus($collectionRate),
                    ]);
                }
            }
        }

        return $results;
    }

    /**
     * Compare year-over-year automatically (current year vs year-1).
     * Includes growth metrics and score for primes.
     *
     * @param int $year
     * @param int|null $centerId
     * @return Collection
     */
    public function compareYoYAuto(int $year, ?int $centerId = null): Collection
    {
        $prevYear = $year - 1;

        $centers = Center::query()
            ->when($centerId !== null, fn($q) => $q->where('id', $centerId))
            ->orderBy('name')
            ->get();

        $results = collect();

        foreach ($centers as $center) {
            // Current year data
            $expectedCurrent = Group::query()
                ->selectRaw('SUM(students_end_count * price_per_student) as total_expected, SUM(students_end_count) as total_students')
                ->where('center_id', $center->id)
                ->where('year', $year)
                ->first();

            $collectedCurrent = CenterMonthlyCollection::query()
                ->selectRaw('SUM(cash_amount + tpe_amount + bank_transfer_amount + cheque_amount) as total_collected')
                ->where('center_id', $center->id)
                ->where('year', $year)
                ->first();

            $expectedCurrentValue = (float) ($expectedCurrent->total_expected ?? 0);
            $totalStudentsCurrentValue = (int) ($expectedCurrent->total_students ?? 0);
            $collectedCurrentValue = (float) ($collectedCurrent->total_collected ?? 0);

            // Previous year data
            $expectedPrev = Group::query()
                ->selectRaw('SUM(students_end_count * price_per_student) as total_expected, SUM(students_end_count) as total_students')
                ->where('center_id', $center->id)
                ->where('year', $prevYear)
                ->first();

            $collectedPrev = CenterMonthlyCollection::query()
                ->selectRaw('SUM(cash_amount + tpe_amount + bank_transfer_amount + cheque_amount) as total_collected')
                ->where('center_id', $center->id)
                ->where('year', $prevYear)
                ->first();

            $expectedPrevValue = (float) ($expectedPrev->total_expected ?? 0);
            $totalStudentsPrevValue = (int) ($expectedPrev->total_students ?? 0);
            $collectedPrevValue = (float) ($collectedPrev->total_collected ?? 0);

            // Calculate rates
            $collectionRateCurrent = $expectedCurrentValue > 0 ? $collectedCurrentValue / $expectedCurrentValue : 0;
            $collectionRatePrev = $expectedPrevValue > 0 ? $collectedPrevValue / $expectedPrevValue : 0;

            // Growth calculations
            $growthCollected = $collectedPrevValue > 0 ? ($collectedCurrentValue - $collectedPrevValue) / $collectedPrevValue : 0;
            $growthExpected = $expectedPrevValue > 0 ? ($expectedCurrentValue - $expectedPrevValue) / $expectedPrevValue : 0;
            $rateChange = $collectionRateCurrent - $collectionRatePrev;

            // Calculate score for primes: 70% collection rate + 30% growth (clamped -1 to +1)
            $clampedGrowth = max(-1, min(1, $growthCollected));
            $score = (0.70 * min($collectionRateCurrent, 1.0)) + (0.30 * (($clampedGrowth + 1) / 2));

            // Determine status (etat_year) with new "Record" logic
            $etat = $this->determineEtatWithRecord($center->id, $year, $collectedCurrentValue, $collectionRateCurrent, $collectedPrevValue, $growthCollected);

            // Only include if there's data in either year
            if ($expectedCurrentValue > 0 || $collectedCurrentValue > 0 || $expectedPrevValue > 0 || $collectedPrevValue > 0) {
                // Normalize keys to match compareYearsBetween for consistent Blade usage
                // yearFrom = current year, yearTo = previous year (for table naming consistency)
                $results->push([
                    'center_id' => $center->id,
                    'center_name' => $center->name,
                    'city' => $center->city,
                    'expected_from' => $expectedCurrentValue,       // Current year (yearFrom)
                    'collected_from' => $collectedCurrentValue,     // Current year (yearFrom)
                    'total_students_from' => $totalStudentsCurrentValue,
                    'collection_rate_from' => $collectionRateCurrent,
                    'expected_to' => $expectedPrevValue,            // Previous year (yearTo)
                    'collected_to' => $collectedPrevValue,          // Previous year (yearTo)
                    'total_students_to' => $totalStudentsPrevValue,
                    'collection_rate_to' => $collectionRatePrev,
                    'yoy_collected_growth' => $growthCollected,
                    'yoy_rate_change' => $rateChange,
                    'score' => $score,
                    'etat_year' => $etat,
                ]);
            }
        }

        return $results;
    }

    /**
     * Compare yearly revenues between two selected years.
     * Returns rows per center with metrics for both years.
     *
     * @param int $yearFrom
     * @param int $yearTo
     * @param int|null $centerId
     * @return Collection
     */
    public function compareYearsBetween(int $yearFrom, int $yearTo, ?int $centerId = null): Collection
    {
        $centers = Center::query()
            ->when($centerId !== null, fn($q) => $q->where('id', $centerId))
            ->orderBy('name')
            ->get();

        $results = collect();

        foreach ($centers as $center) {
            // yearFrom data
            $expectedFrom = Group::query()
                ->selectRaw('SUM(students_end_count * price_per_student) as total_expected, SUM(students_end_count) as total_students')
                ->where('center_id', $center->id)
                ->where('year', $yearFrom)
                ->first();

            $collectedFrom = CenterMonthlyCollection::query()
                ->selectRaw('SUM(cash_amount + tpe_amount + bank_transfer_amount + cheque_amount) as total_collected')
                ->where('center_id', $center->id)
                ->where('year', $yearFrom)
                ->first();

            $expectedFromValue = (float) ($expectedFrom->total_expected ?? 0);
            $totalStudentsFrom = (int) ($expectedFrom->total_students ?? 0);
            $collectedFromValue = (float) ($collectedFrom->total_collected ?? 0);

            // yearTo data
            $expectedTo = Group::query()
                ->selectRaw('SUM(students_end_count * price_per_student) as total_expected, SUM(students_end_count) as total_students')
                ->where('center_id', $center->id)
                ->where('year', $yearTo)
                ->first();

            $collectedTo = CenterMonthlyCollection::query()
                ->selectRaw('SUM(cash_amount + tpe_amount + bank_transfer_amount + cheque_amount) as total_collected')
                ->where('center_id', $center->id)
                ->where('year', $yearTo)
                ->first();

            $expectedToValue = (float) ($expectedTo->total_expected ?? 0);
            $totalStudentsTo = (int) ($expectedTo->total_students ?? 0);
            $collectedToValue = (float) ($collectedTo->total_collected ?? 0);

            // Calculate rates
            $collectionRateFrom = $expectedFromValue > 0 ? $collectedFromValue / $expectedFromValue : 0;
            $collectionRateTo = $expectedToValue > 0 ? $collectedToValue / $expectedToValue : 0;

            // Year-over-year growth (relative to yearTo as baseline)
            $yoyCollectedGrowth = $collectedToValue > 0 ? ($collectedFromValue - $collectedToValue) / $collectedToValue : 0;
            $yoyRateChange = $collectionRateFrom - $collectionRateTo;

            // Determine status (etat_year) for yearFrom
            if ($expectedToValue == 0 && $collectedToValue == 0 && ($expectedFromValue > 0 || $collectedFromValue > 0)) {
                $etat = 'Nouveau chiffre attendu';
            } elseif ($collectedToValue > 0 && $yoyCollectedGrowth < -0.10) {
                $etat = 'Mauvaise année';
            } else {
                $etat = $this->getStatus($collectionRateFrom);
            }

            // Only include if there's data in either year
            if ($expectedFromValue > 0 || $collectedFromValue > 0 || $expectedToValue > 0 || $collectedToValue > 0) {
                $results->push([
                    'center_id' => $center->id,
                    'center_name' => $center->name,
                    'city' => $center->city,
                    'expected_from' => $expectedFromValue,
                    'collected_from' => $collectedFromValue,
                    'total_students_from' => $totalStudentsFrom,
                    'collection_rate_from' => $collectionRateFrom,
                    'expected_to' => $expectedToValue,
                    'collected_to' => $collectedToValue,
                    'total_students_to' => $totalStudentsTo,
                    'collection_rate_to' => $collectionRateTo,
                    'yoy_collected_growth' => $yoyCollectedGrowth,
                    'yoy_rate_change' => $yoyRateChange,
                    'etat_year' => $etat,
                ]);
            }
        }

        return $results;
    }

    /**
     * Get multi-year trend for a specific center (all years available).
     * Returns collection with one row per year.
     *
     * @param int $centerId
     * @return Collection
     */
    public function trendMultiYear(int $centerId): Collection
    {
        // Get all available years for this center
        $yearsFromGroups = Group::query()
            ->where('center_id', $centerId)
            ->select('year')
            ->distinct()
            ->pluck('year')
            ->values();

        $yearsFromCollections = CenterMonthlyCollection::query()
            ->where('center_id', $centerId)
            ->select('year')
            ->distinct()
            ->pluck('year')
            ->values();

        $allYears = $yearsFromGroups->merge($yearsFromCollections)
            ->unique()
            ->sort()
            ->reverse()
            ->values();

        $center = Center::find($centerId);
        if (!$center) {
            return collect();
        }

        $results = collect();

        foreach ($allYears as $year) {
            $expected = Group::query()
                ->selectRaw('SUM(students_end_count * price_per_student) as total_expected, SUM(students_end_count) as total_students')
                ->where('center_id', $centerId)
                ->where('year', $year)
                ->first();

            $collected = CenterMonthlyCollection::query()
                ->selectRaw('SUM(cash_amount + tpe_amount + bank_transfer_amount + cheque_amount) as total_collected')
                ->where('center_id', $centerId)
                ->where('year', $year)
                ->first();

            $expectedValue = (float) ($expected->total_expected ?? 0);
            $totalStudents = (int) ($expected->total_students ?? 0);
            $collectedValue = (float) ($collected->total_collected ?? 0);

            $collectionRate = $expectedValue > 0 ? $collectedValue / $expectedValue : 0;

            // Only include if there's data
            if ($expectedValue > 0 || $collectedValue > 0) {
                $results->push([
                    'year' => $year,
                    'expected_year' => $expectedValue,
                    'collected_year' => $collectedValue,
                    'total_students' => $totalStudents,
                    'collection_rate_year' => $collectionRate,
                    'etat_year' => $this->getStatus($collectionRate),
                ]);
            }
        }

        return $results->sortByDesc('year')->values();
    }

    /**
     * Get multi-year trend summary (best collected, best year, record info).
     *
     * @param int $centerId
     * @return array
     */
    public function trendMultiYearSummary(int $centerId): array
    {
        $trend = $this->trendMultiYear($centerId);

        $bestCollected = 0;
        $bestYear = null;

        foreach ($trend as $row) {
            if ($row['collected_year'] > $bestCollected) {
                $bestCollected = $row['collected_year'];
                $bestYear = $row['year'];
            }
        }

        return [
            'best_collected_ever' => $bestCollected,
            'best_year' => $bestYear,
        ];
    }

    /**
     * Rank centers by performance for a specific year (with optional min rate filter).
     * Ranked by score descending for primes selection.
     *
     * @param int $year
     * @param float $minRate
     * @return Collection
     */
    public function rankingYear(int $year, float $minRate = 0): Collection
    {
        $prevYear = $year - 1;

        $centers = Center::query()
            ->where('active', true)
            ->orderBy('name')
            ->get();

        $results = collect();

        foreach ($centers as $center) {
            // Current year data
            $expectedCurrent = Group::query()
                ->selectRaw('SUM(students_end_count * price_per_student) as total_expected, SUM(students_end_count) as total_students')
                ->where('center_id', $center->id)
                ->where('year', $year)
                ->first();

            $collectedCurrent = CenterMonthlyCollection::query()
                ->selectRaw('SUM(cash_amount + tpe_amount + bank_transfer_amount + cheque_amount) as total_collected')
                ->where('center_id', $center->id)
                ->where('year', $year)
                ->first();

            $expectedCurrentValue = (float) ($expectedCurrent->total_expected ?? 0);
            $collectedCurrentValue = (float) ($collectedCurrent->total_collected ?? 0);

            // Previous year data (for growth calculation)
            $collectedPrev = CenterMonthlyCollection::query()
                ->selectRaw('SUM(cash_amount + tpe_amount + bank_transfer_amount + cheque_amount) as total_collected')
                ->where('center_id', $center->id)
                ->where('year', $prevYear)
                ->first();

            $collectedPrevValue = (float) ($collectedPrev->total_collected ?? 0);

            // Calculate collection rate
            $collectionRateCurrent = $expectedCurrentValue > 0 ? $collectedCurrentValue / $expectedCurrentValue : 0;

            // Apply min rate filter
            if ($collectionRateCurrent < $minRate) {
                continue;
            }

            // Growth calculation
            $growthCollected = $collectedPrevValue > 0 ? ($collectedCurrentValue - $collectedPrevValue) / $collectedPrevValue : 0;

            // Score calculation: 70% rate + 30% growth
            $clampedGrowth = max(-1, min(1, $growthCollected));
            $score = (0.70 * min($collectionRateCurrent, 1.0)) + (0.30 * (($clampedGrowth + 1) / 2));

            // Determine status with record logic
            $etat = $this->determineEtatWithRecord($center->id, $year, $collectedCurrentValue, $collectionRateCurrent, $collectedPrevValue, $growthCollected);

            // Only include if there's data in current year
            if ($expectedCurrentValue > 0 || $collectedCurrentValue > 0) {
                $results->push([
                    'rank' => 0,  // Will be set after sorting
                    'center_id' => $center->id,
                    'center_name' => $center->name,
                    'city' => $center->city,
                    'expected_current' => $expectedCurrentValue,
                    'collected_current' => $collectedCurrentValue,
                    'collection_rate_current' => $collectionRateCurrent,
                    'growth_collected' => $growthCollected,
                    'score' => $score,
                    'etat_year' => $etat,
                ]);
            }
        }

        // Sort by score descending
        $sorted = $results->sortByDesc('score')->values();

        // Add rank
        $sorted->transform(function ($item, $key) {
            $item['rank'] = $key + 1;
            return $item;
        });

        return $sorted;
    }

    /**
     * Determine etat_year with record logic.
     * Priority: Nouveau chiffre attendu > Très bonne année (Record) > Mauvaise année > Normal/À surveiller/Problème
     *
     * @param int $centerId
     * @param int $year
     * @param float $collectedCurrent
     * @param float $collectionRateCurrent
     * @param float $collectedPrev
     * @param float $growthCollected
     * @return string
     */
    private function determineEtatWithRecord(
        int $centerId,
        int $year,
        float $collectedCurrent,
        float $collectionRateCurrent,
        float $collectedPrev,
        float $growthCollected
    ): string {
        // Check for "Nouveau chiffre attendu" (no baseline)
        if ($collectedPrev == 0 && $collectedCurrent > 0) {
            return 'Nouveau chiffre attendu';
        }

        // Check for "Très bonne année (Record)" - is this year's collected highest ever for this center?
        if ($collectedCurrent > 0 && $this->isRecordYear($centerId, $year, $collectedCurrent)) {
            return 'Très bonne année (Record)';
        }

        // Check for "Mauvaise année"
        if ($collectedPrev > 0 && $growthCollected < -0.10) {
            return 'Mauvaise année';
        }

        // Standard thresholds based on collection rate
        return $this->getStatus($collectionRateCurrent);
    }

    /**
     * Check if a year is a record (highest collected ever) for a center.
     *
     * @param int $centerId
     * @param int $year
     * @param float $collectedCurrent
     * @return bool
     */
    private function isRecordYear(int $centerId, int $year, float $collectedCurrent): bool
    {
        // Get max collected across all years for this center
        $yearlyData = CenterMonthlyCollection::query()
            ->selectRaw('SUM(cash_amount + tpe_amount + bank_transfer_amount + cheque_amount) as total_collected')
            ->selectRaw('year')
            ->where('center_id', $centerId)
            ->groupBy('year')
            ->get();

        if ($yearlyData->isEmpty()) {
            return false;
        }

        // Find the maximum collected value
        $maxCollected = (float) $yearlyData->max('total_collected');

        // Current year is a record if its collected amount equals the max and is > 0
        return $collectedCurrent > 0 && $collectedCurrent >= $maxCollected;
    }

    /**
     * Legacy method for backward compatibility.
     * Delegates to compareMonthlyYear without month grouping.
     *
     * @param int $year
     * @param int|null $month
     * @return Collection
     * @deprecated Use compareMonthlyYear() or compareYoYAuto() instead
     */
    public function compare(int $year, ?int $month = null): Collection
    {
        $results = $this->compareMonthlyYear($year);

        if ($month !== null) {
            $results = $results->filter(fn($row) => $row['month'] === $month);
        }

        return $results;
    }

    /**
     * Legacy method for backward compatibility.
     * Delegates to compareMonthlyYear.
     *
     * @param int $year
     * @param int|null $centerId
     * @return Collection
     * @deprecated Use compareMonthlyYear() instead
     */
    public function compareMonthly(int $year, ?int $centerId = null): Collection
    {
        return $this->compareMonthlyYear($year, $centerId);
    }

    /**
     * Legacy method for backward compatibility.
     * Delegates to compareYoYAuto.
     *
     * @param int $year
     * @param int|null $centerId
     * @return Collection
     * @deprecated Use compareYoYAuto() instead
     */
    public function compareYearly(int $year, ?int $centerId = null): Collection
    {
        return $this->compareYoYAuto($year, $centerId);
    }

    /**
     * Legacy method for backward compatibility.
     * Delegates to compareYearsBetween.
     *
     * @param int $yearFrom
     * @param int $yearTo
     * @param int|null $centerId
     * @return Collection
     * @deprecated Use compareYearsBetween() instead
     */
    public function compareYearlyBetween(int $yearFrom, int $yearTo, ?int $centerId = null): Collection
    {
        return $this->compareYearsBetween($yearFrom, $yearTo, $centerId);
    }
}
