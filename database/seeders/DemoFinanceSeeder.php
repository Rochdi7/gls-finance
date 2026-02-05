<?php

namespace Database\Seeders;

use App\Models\Center;
use App\Models\CenterMonthlyCollection;
use App\Models\Group;
use App\Models\GroupMonthlyStat;
use App\Models\MonthlyFinancial;
use App\Models\Professor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class DemoFinanceSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {

            // ✅ Reset total (ok avec migrate:fresh --seed)
            // IMPORTANT: delete enfants avant parents
            GroupMonthlyStat::query()->delete();
            CenterMonthlyCollection::query()->delete();
            Group::query()->delete();
            MonthlyFinancial::query()->delete();
            Professor::query()->delete();
            Center::query()->delete();

            /**
             * =========================
             * CENTERS
             * =========================
             */
            $centers = collect([
                ['name' => 'GLS Marrakech',  'city' => 'Marrakech',  'active' => true],
                ['name' => 'GLS Casablanca', 'city' => 'Casablanca', 'active' => true],
                ['name' => 'GLS Salé',       'city' => 'Salé',       'active' => true],
                ['name' => 'GLS Rabat',      'city' => 'Rabat',      'active' => true],
                ['name' => 'GLS Kénitra',    'city' => 'Kénitra',    'active' => true],
                ['name' => 'GLS Agadir',     'city' => 'Agadir',     'active' => true],
                ['name' => 'GLS Online',     'city' => 'Online',     'active' => true],
            ])->map(fn ($c) => Center::create($c));

            /**
             * =========================
             * PROFESSORS (par center)
             * =========================
             */
            $namesPool = collect([
                'Hicham', 'Sara', 'Youssef', 'Khadija', 'Amina', 'Othman',
                'Nadia', 'Hamza', 'Imane', 'Rachid', 'Salma', 'Adil',
                'Aya', 'Mehdi', 'Karim', 'Samira', 'Laila', 'Anas',
            ]);

            $professorsByCenter = collect();

            foreach ($centers as $center) {
                $count = match ($center->city) {
                    'Casablanca' => 6,
                    'Marrakech'  => 6,
                    'Rabat'      => 5,
                    'Online'     => 4,
                    default      => 3,
                };

                $picked = $namesPool->shuffle()->take($count);

                $created = $picked->map(function ($name) use ($center) {
                    return Professor::create([
                        'center_id' => $center->id,
                        'name'      => $name,
                        'active'    => true,
                    ]);
                });

                $professorsByCenter->put($center->id, $created);
            }

            /**
             * =========================
             * LEVEL BASE PRICE (stable)
             * =========================
             */
            $levelBasePrice = [
                'A1' => rand(380, 460),
                'A2' => rand(450, 560),
                'B1' => rand(520, 700),
                'B2' => rand(650, 850),
            ];

            /**
             * =========================================================
             * HELPER : build realistic 10-month timeline
             * =========================================================
             */
            $buildTenMonthsStats = function (int $startMonth, int $year, int $startStudents, int $price) {
                $months = [];
                $current = $startStudents;

                for ($i = 0; $i < 10; $i++) {
                    $m = $startMonth + $i;
                    if ($m > 12) break;

                    $newStudents = rand(0, 3);
                    $loss = rand(0, min(4, $current + $newStudents));

                    $monthStart = max(0, $current + $newStudents);
                    $monthEnd   = max(0, $monthStart - $loss);

                    $months[] = [
                        'month'   => $m,
                        'year'    => $year,
                        'start'   => $monthStart,
                        'end'     => $monthEnd,
                        'revenue' => (int) ($monthEnd * $price),
                    ];

                    $current = $monthEnd;
                }

                return $months;
            };

            /**
             * =========================================================
             * HELPER : split revenue into 4 payment methods
             * - ensures sum == total (in cents)
             * =========================================================
             */
            $splitRevenue = function (int $total) {
                // total est un "int" (MAD/EUR) dans ton projet -> on convertit en cents pour être exact
                $totalCents = max(0, (int) round($total * 100));

                if ($totalCents === 0) {
                    return [0, 0, 0, 0];
                }

                // poids réalistes (cash souvent élevé)
                $wCash   = rand(25, 55);
                $wTpe    = rand(15, 35);
                $wBank   = rand(10, 30);
                $wCheque = rand(0, 20);

                $sumW = $wCash + $wTpe + $wBank + $wCheque;

                $cash   = (int) floor($totalCents * ($wCash / $sumW));
                $tpe    = (int) floor($totalCents * ($wTpe / $sumW));
                $bank   = (int) floor($totalCents * ($wBank / $sumW));
                $cheque = (int) floor($totalCents * ($wCheque / $sumW));

                // Ajuster le reste pour tomber EXACT
                $allocated = $cash + $tpe + $bank + $cheque;
                $diff = $totalCents - $allocated;

                // on met le diff sur la méthode la plus "flexible" : cash puis tpe
                if ($diff !== 0) {
                    $cash += $diff;
                }

                // Retour en unité monétaire
                return [
                    $cash / 100,
                    $tpe / 100,
                    $bank / 100,
                    $cheque / 100,
                ];
            };

            /**
             * =========================================================
             * PART 1: HISTORIQUE (2024, 2025)
             * =========================================================
             */
            foreach ([2024, 2025] as $year) {

                $allMonthlyStats = collect();

                foreach ($centers as $center) {

                    $centerProfessors = $professorsByCenter->get($center->id, collect());
                    if ($centerProfessors->isEmpty()) {
                        $centerProfessors = collect([
                            Professor::create([
                                'center_id' => $center->id,
                                'name'      => 'Prof ' . $center->city,
                                'active'    => true,
                            ])
                        ]);
                        $professorsByCenter->put($center->id, $centerProfessors);
                    }

                    $cohortsCount = match ($center->city) {
                        'Casablanca' => rand(6, 10),
                        'Marrakech'  => rand(6, 10),
                        'Rabat'      => rand(4, 8),
                        'Online'     => rand(4, 7),
                        default      => rand(3, 6),
                    };

                    $used = [];
                    $tries = 0;

                    while (count($used) < $cohortsCount && $tries < 250) {
                        $tries++;

                        $level = Arr::random(Group::LEVELS);
                        $professorId = $centerProfessors->random()->id;
                        $startMonth = rand(1, 12);

                        $key = $level . '-' . $professorId . '-' . $startMonth;
                        if (isset($used[$key])) continue;
                        $used[$key] = true;

                        $assignProfessor = rand(0, 100) > 8;
                        $professorIdFinal = $assignProfessor ? $professorId : null;

                        $price = (int) $levelBasePrice[$level] + rand(-30, 60);
                        $startStudents = rand(10, 22);

                        $mm = str_pad((string) $startMonth, 2, '0', STR_PAD_LEFT);
                        $name = "{$level} – {$center->name} – {$mm}/{$year}";

                        $status = (rand(0, 100) > 15) ? 'finished' : Arr::random(Group::STATUSES);

                        $timeline = $buildTenMonthsStats($startMonth, $year, $startStudents, $price);
                        if (empty($timeline)) continue;

                        $first = $timeline[0];

                        $g = Group::create([
                            'center_id'            => $center->id,
                            'professor_id'         => $professorIdFinal,
                            'name'                 => $name,
                            'level_code'           => $level,
                            'students_start_count' => (int) $first['start'],
                            'students_end_count'   => (int) $first['end'],
                            'price_per_student'    => $price,
                            'month'                => (int) $first['month'],
                            'year'                 => $year,
                            'status'               => $status,
                        ]);

                        foreach ($timeline as $row) {
                            GroupMonthlyStat::create([
                                'group_id' => $g->id,
                                'month' => (int) $row['month'],
                                'year'  => (int) $row['year'],
                                'students_start_count' => (int) $row['start'],
                                'students_end_count'   => (int) $row['end'],
                                'revenue' => (int) $row['revenue'],
                            ]);

                            $allMonthlyStats->push([
                                'center_id' => $center->id,
                                'month' => (int) $row['month'],
                                'year' => (int) $row['year'],
                                'students_end_count' => (int) $row['end'],
                                'revenue' => (int) $row['revenue'],
                            ]);
                        }
                    }
                }

                // ✅ MonthlyFinancial pour chaque center/mois depuis stats
                for ($month = 1; $month <= 12; $month++) {
                    foreach ($centers as $center) {

                        $rows = $allMonthlyStats
                            ->where('center_id', $center->id)
                            ->where('month', $month)
                            ->where('year', $year);

                        $totalStudents = (int) $rows->sum('students_end_count');
                        $totalRevenue  = (int) $rows->sum('revenue');

                        $mf = MonthlyFinancial::create([
                            'center_id'      => $center->id,
                            'month'          => $month,
                            'year'           => $year,
                            'total_students' => $totalStudents,
                            'total_revenue'  => $totalRevenue,
                            'is_historical'  => true,
                            'locked'         => (bool) rand(0, 1),
                        ]);

                        $mf->fillSplitFromRevenue()->save();
                    }
                }
            }

            /**
             * =========================================================
             * PART 2: LIVE (2026)
             * =========================================================
             */
            $allMonthlyStats2026 = collect();

            foreach ($centers as $center) {

                $centerProfessors = $professorsByCenter->get($center->id, collect());
                if ($centerProfessors->isEmpty()) {
                    $centerProfessors = collect([
                        Professor::create([
                            'center_id' => $center->id,
                            'name'      => 'Prof ' . $center->city,
                            'active'    => true,
                        ])
                    ]);
                    $professorsByCenter->put($center->id, $centerProfessors);
                }

                $cohortsCount = match ($center->city) {
                    'Casablanca' => rand(7, 11),
                    'Marrakech'  => rand(7, 11),
                    'Rabat'      => rand(5, 9),
                    'Online'     => rand(5, 8),
                    default      => rand(3, 7),
                };

                $used = [];
                $tries = 0;

                while (count($used) < $cohortsCount && $tries < 300) {
                    $tries++;

                    $level = Arr::random(Group::LEVELS);
                    $professorId = $centerProfessors->random()->id;
                    $startMonth = rand(1, 12);

                    $key = $level . '-' . $professorId . '-' . $startMonth;
                    if (isset($used[$key])) continue;
                    $used[$key] = true;

                    $price = (int) $levelBasePrice[$level] + rand(-20, 40);
                    $startStudents = rand(8, 18);

                    $mm = str_pad((string) $startMonth, 2, '0', STR_PAD_LEFT);
                    $name = "{$level} – {$center->name} – {$mm}/2026";

                    $timeline = $buildTenMonthsStats($startMonth, 2026, $startStudents, $price);
                    if (empty($timeline)) continue;

                    $first = $timeline[0];

                    $group = Group::create([
                        'center_id'            => $center->id,
                        'professor_id'         => $professorId,
                        'name'                 => $name,
                        'level_code'           => $level,
                        'students_start_count' => (int) $first['start'],
                        'students_end_count'   => (int) $first['end'],
                        'price_per_student'    => $price,
                        'month'                => (int) $first['month'],
                        'year'                 => 2026,
                        'status'               => Arr::random(Group::STATUSES),
                    ]);

                    foreach ($timeline as $row) {
                        GroupMonthlyStat::create([
                            'group_id' => $group->id,
                            'month' => (int) $row['month'],
                            'year'  => 2026,
                            'students_start_count' => (int) $row['start'],
                            'students_end_count'   => (int) $row['end'],
                            'revenue' => (int) $row['revenue'],
                        ]);

                        $allMonthlyStats2026->push([
                            'center_id' => $center->id,
                            'month' => (int) $row['month'],
                            'year' => 2026,
                            'students_end_count' => (int) $row['end'],
                            'revenue' => (int) $row['revenue'],
                        ]);
                    }
                }
            }

            for ($month = 1; $month <= 12; $month++) {
                foreach ($centers as $center) {

                    $rows = $allMonthlyStats2026
                        ->where('center_id', $center->id)
                        ->where('month', $month);

                    $totalStudents = (int) $rows->sum('students_end_count');
                    $totalRevenue  = (int) $rows->sum('revenue');

                    $mf = MonthlyFinancial::create([
                        'center_id'      => $center->id,
                        'month'          => $month,
                        'year'           => 2026,
                        'total_students' => $totalStudents,
                        'total_revenue'  => $totalRevenue,
                        'is_historical'  => false,
                        'locked'         => false,
                    ]);

                    $mf->fillSplitFromRevenue()->save();
                }
            }

            /**
 * =========================================================
 * PART 3: Center Monthly Collections (Payments)
 * - 2024 / 2025 / 2026
 * =========================================================
 */
$allMF = MonthlyFinancial::query()
    ->orderBy('year')
    ->orderBy('month')
    ->get();

foreach ($allMF as $mf) {

    // Sécurité : ignorer mois sans revenu
    if ((int) $mf->total_revenue <= 0) {
        continue;
    }

    [$cash, $tpe, $bank, $cheque] = $splitRevenue((int) $mf->total_revenue);

    CenterMonthlyCollection::updateOrCreate(
        [
            'center_id' => (int) $mf->center_id,
            'year'      => (int) $mf->year,   // 🔥 2024 / 2025 / 2026
            'month'     => (int) $mf->month,
        ],
        [
            'cash_amount'          => $cash,
            'tpe_amount'           => $tpe,
            'bank_transfer_amount' => $bank,
            'cheque_amount'        => $cheque,
            'note' => match (true) {
                $mf->year === 2024 => 'Seed historique 2024',
                $mf->year === 2025 => 'Seed historique 2025',
                default            => 'Seed live 2026',
            },
        ]
    );
}

        });
    }
}
