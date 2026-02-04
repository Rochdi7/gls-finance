<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\Center;
use App\Models\CenterMonthlyCollection;
use App\Models\Group;
use App\Services\Finance\CenterComparisonService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CenterComparisonController extends Controller
{
    public function __construct(
        private CenterComparisonService $comparisonService
    ) {}

    /**
     * Display center comparison with flexible filter types.
     * Supported types: monthly_year, yoy_auto, years_between, trend_multi_year, ranking_year
     */
    public function index(Request $request): View|RedirectResponse
    {
        // Type: comparison type (default monthly_year)
        $type = $request->filled('type') ? $request->get('type') : 'monthly_year';
        $validTypes = ['monthly_year', 'yoy_auto', 'years_between', 'trend_multi_year', 'ranking_year'];
        if (!in_array($type, $validTypes, true)) {
            $type = 'monthly_year';
        }

        // Get available years from both groups and collections
        $availableYearsGroups = Group::query()
            ->select('year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->values();

        $availableYearsCollections = CenterMonthlyCollection::query()
            ->select('year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->values();

        $availableYears = $availableYearsGroups->merge($availableYearsCollections)
            ->unique()
            ->sort()
            ->reverse()
            ->values();

        // Center filter (optional, required for trend_multi_year)
        $centerId = $request->filled('center_id') ? (int) $request->get('center_id') : null;

        // Get centers for filter dropdown
        $centers = Center::query()
            ->where('active', true)
            ->orderBy('name')
            ->get();

        // French month names
        $monthNames = [
            1 => 'Janvier',
            2 => 'Février',
            3 => 'Mars',
            4 => 'Avril',
            5 => 'Mai',
            6 => 'Juin',
            7 => 'Juillet',
            8 => 'Août',
            9 => 'Septembre',
            10 => 'Octobre',
            11 => 'Novembre',
            12 => 'Décembre',
        ];

        // Default year
        $defaultYear = (int) now()->year;

        // Handle type-specific parameters and data retrieval
        switch ($type) {
            case 'monthly_year':
                // Monthly breakdown in a single year - YEAR IS REQUIRED
                if (!$request->filled('year')) {
                    return redirect()
                        ->back()
                        ->withInput()
                        ->with('toast', [
                            'title' => 'Validation',
                            'message' => 'Veuillez choisir une année pour la comparaison mensuelle.',
                            'dot' => 'warning',
                            'delay' => 5000,
                            'time' => true,
                        ]);
                }

                $year = (int) $request->get('year');
                $rows = $this->comparisonService->compareMonthlyYear($year, $centerId);

                // Calculate summary for monthly_year
                $totalExpected = (float) $rows->sum('expected_revenue');
                $totalCollected = (float) $rows->sum('collected_revenue');
                $globalRate = $totalExpected > 0 ? ($totalCollected / $totalExpected) : 0;

                // Find best and worst month (by collection_rate, only where expected > 0)
                $bestMonthName = 'N/A';
                $bestRate = -1;

                $worstMonthName = 'N/A';
                $worstRate = 2;

                foreach ($rows as $row) {
                    $expectedRevenue = (float) ($row['expected_revenue'] ?? 0);
                    $rate = (float) ($row['collection_rate'] ?? 0);
                    $month = (int) ($row['month'] ?? 0);

                    if ($expectedRevenue <= 0 || $month < 1 || $month > 12) {
                        continue;
                    }

                    if ($rate > $bestRate) {
                        $bestRate = $rate;
                        $bestMonthName = $monthNames[$month] ?? 'N/A';
                    }

                    if ($rate < $worstRate) {
                        $worstRate = $rate;
                        $worstMonthName = $monthNames[$month] ?? 'N/A';
                    }
                }

                $summary = [
                    'total_expected_year' => $totalExpected,
                    'total_collected_year' => $totalCollected,
                    'global_rate' => $globalRate,
                    'best_month_name' => $bestMonthName,
                    'worst_month_name' => $worstMonthName,
                ];

                return view('finance.center-comparison.index', [
                    'rows' => $rows,
                    'type' => $type,
                    'mode' => 'monthly_compare',
                    'year' => $year,
                    'centerId' => $centerId,
                    'centers' => $centers,
                    'availableYears' => $availableYears,
                    'monthNames' => $monthNames,
                    'summary' => $summary,
                    'page_title' => 'Comparaison Centres',
                ]);

            case 'yoy_auto':
                // Year-over-year automatic (year vs year-1)
                $year = $request->filled('year') ? (int) $request->get('year') : $defaultYear;
                $yearFrom = $year;
                $yearTo = $year - 1;

                $rows = $this->comparisonService->compareYoYAuto($year, $centerId);

                return view('finance.center-comparison.index', [
                    'rows' => $rows,
                    'type' => $type,
                    'year' => $year,
                    'yearFrom' => $yearFrom,
                    'yearTo' => $yearTo,
                    'centerId' => $centerId,
                    'centers' => $centers,
                    'availableYears' => $availableYears,
                    'monthNames' => $monthNames,
                    'page_title' => 'Comparaison Centres',
                ]);

            case 'years_between':
                // Comparison between two chosen years
                $defaultYearFrom = $defaultYear;
                $defaultYearTo = $availableYears->count() >= 2 ? (int) $availableYears[1] : ($defaultYear - 1);

                $yearFrom = $request->filled('year_from') ? (int) $request->get('year_from') : $defaultYearFrom;
                $yearTo = $request->filled('year_to') ? (int) $request->get('year_to') : $defaultYearTo;

                $rows = $this->comparisonService->compareYearsBetween($yearFrom, $yearTo, $centerId);

                return view('finance.center-comparison.index', [
                    'rows' => $rows,
                    'type' => $type,
                    'yearFrom' => $yearFrom,
                    'yearTo' => $yearTo,
                    'centerId' => $centerId,
                    'centers' => $centers,
                    'availableYears' => $availableYears,
                    'monthNames' => $monthNames,
                    'page_title' => 'Comparaison Centres',
                ]);

            case 'trend_multi_year':
                // Multi-year trend for a specific center
                if (!$centerId) {
                    return view('finance.center-comparison.index', [
                        'rows' => collect(),
                        'type' => $type,
                        'centerId' => $centerId,
                        'centers' => $centers,
                        'availableYears' => $availableYears,
                        'monthNames' => $monthNames,
                        'page_title' => 'Comparaison Centres',
                        'errorMessage' => 'Veuillez choisir un centre pour afficher la tendance multi-années.',
                    ]);
                }

                $rows = $this->comparisonService->trendMultiYear($centerId);
                $trendSummary = $this->comparisonService->trendMultiYearSummary($centerId);

                return view('finance.center-comparison.index', [
                    'rows' => $rows,
                    'trendSummary' => $trendSummary,
                    'type' => $type,
                    'centerId' => $centerId,
                    'centers' => $centers,
                    'availableYears' => $availableYears,
                    'monthNames' => $monthNames,
                    'page_title' => 'Comparaison Centres',
                ]);

            case 'ranking_year':
                $year = $request->filled('year') ? (int) $request->get('year') : $defaultYear;
                $minRate = $request->filled('min_rate') ? ((float) $request->get('min_rate') / 100) : 0;

                $rows = $this->comparisonService->rankingYear($year, $minRate);

                return view('finance.center-comparison.index', [
                    'rows' => $rows,
                    'type' => $type,
                    'year' => $year,
                    'minRate' => $minRate,
                    'centers' => $centers,
                    'availableYears' => $availableYears,
                    'monthNames' => $monthNames,
                    'page_title' => 'Comparaison Centres',
                ]);

            default:
                return view('finance.center-comparison.index', [
                    'rows' => collect(),
                    'type' => $type,
                    'centers' => $centers,
                    'availableYears' => $availableYears,
                    'monthNames' => $monthNames,
                    'page_title' => 'Comparaison Centres',
                ]);
        }
    }
}
