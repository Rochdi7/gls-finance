<?php

namespace Database\Seeders;

use App\Models\Center;
use App\Models\Group;
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

            // Reset total (ok avec migrate:fresh --seed)
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
             * ✅ chaque center a ses professeurs
             * =========================
             */
            $namesPool = collect([
                'Hicham', 'Sara', 'Youssef', 'Khadija', 'Amina', 'Othman',
                'Nadia', 'Hamza', 'Imane', 'Rachid', 'Salma', 'Adil',
                'Aya', 'Mehdi', 'Karim', 'Samira', 'Laila', 'Anas',
            ]);

            // Map: center_id => Collection<Professor>
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
             * =========================
             * GROUPS + MONTHLY FINANCIALS (2024, 2025)  ✅
             * - crée des groups (pour que yearly page affiche)
             * - monthly_financials = historique
             * =========================
             */
            foreach ([2024, 2025] as $year) {
                for ($month = 1; $month <= 12; $month++) {
                    foreach ($centers as $center) {

                        // combien de groupes sur ce mois (historique)
                        $groupsCount = match ($center->city) {
                            'Casablanca' => rand(3, 6),
                            'Marrakech'  => rand(3, 6),
                            'Rabat'      => rand(2, 5),
                            'Online'     => rand(2, 4),
                            default      => rand(1, 4),
                        };

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

                        // contrainte unique: (center_id, level_code, professor_id, month, year)
                        $usedCombos = [];
                        $tries = 0;

                        $groupsCreated = collect();

                        while ($groupsCreated->count() < $groupsCount && $tries < 120) {
                            $tries++;

                            $level = Arr::random(Group::LEVELS);
                            $professorId = $centerProfessors->random()->id;

                            $comboKey = $level . '-' . $professorId;

                            if (isset($usedCombos[$comboKey])) {
                                continue;
                            }

                            $usedCombos[$comboKey] = true;

                            $start = rand(10, 22);
                            $end   = max(0, $start - rand(0, 6));

                            $price = (int) $levelBasePrice[$level] + rand(-30, 60);

                            $status = Arr::random(Group::STATUSES);

                            // Petit réalisme: historique plutôt "finished"
                            if (rand(0, 100) > 15) {
                                $status = 'finished';
                            }

                            // de temps en temps, groupe non affecté
                            $assignProfessor = rand(0, 100) > 8; // 92% affecté
                            $professorIdFinal = $assignProfessor ? $professorId : null;

                            $g = Group::create([
                                'center_id'            => $center->id,
                                'professor_id'         => $professorIdFinal,
                                'level_code'           => $level,
                                'students_start_count' => $start,
                                'students_end_count'   => $end,
                                'price_per_student'    => $price,
                                'month'                => $month,
                                'year'                 => $year,
                                'status'               => $status,
                            ]);

                            $groupsCreated->push($g);
                        }

                        // Monthly totals depuis groups (même pour historique)
                        $totalStudents = (int) $groupsCreated->sum('students_end_count');
                        $totalRevenue  = (int) $groupsCreated->sum(fn (Group $g) => $g->revenue());

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
             * =========================
             * LIVE GROUPS (2026)
             * ✅ professor doit appartenir au même center
             * ✅ Respecte UNIQUE (center_id, level_code, professor_id, month, year)
             * =========================
             */
            $allGroups2026 = collect();

            for ($month = 1; $month <= 12; $month++) {
                foreach ($centers as $center) {

                    $groupsCount = match ($center->city) {
                        'Casablanca' => rand(3, 5),
                        'Marrakech'  => rand(3, 5),
                        'Rabat'      => rand(2, 4),
                        'Online'     => rand(2, 4),
                        default      => rand(1, 3),
                    };

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

                    $usedCombos = [];
                    $tries = 0;

                    while (count($usedCombos) < $groupsCount && $tries < 120) {
                        $tries++;

                        $level = Arr::random(Group::LEVELS);
                        $professorId = $centerProfessors->random()->id;

                        $comboKey = $level . '-' . $professorId;

                        if (isset($usedCombos[$comboKey])) {
                            continue;
                        }

                        $usedCombos[$comboKey] = true;

                        $start = rand(8, 18);
                        $end   = max(0, $start - rand(0, 4));

                        $price = (int) $levelBasePrice[$level] + rand(-20, 40);

                        $group = Group::create([
                            'center_id'            => $center->id,
                            'professor_id'         => $professorId,
                            'level_code'           => $level,
                            'students_start_count' => $start,
                            'students_end_count'   => $end,
                            'price_per_student'    => $price,
                            'month'                => $month,
                            'year'                 => 2026,
                            'status'               => Arr::random(Group::STATUSES),
                        ]);

                        $allGroups2026->push($group);
                    }
                }
            }

            /**
             * =========================
             * 2026 : MONTHLY_FINANCIALS calculés depuis groups
             * =========================
             */
            for ($month = 1; $month <= 12; $month++) {
                foreach ($centers as $center) {

                    $groups = $allGroups2026
                        ->where('center_id', $center->id)
                        ->where('month', $month);

                    $totalStudents = (int) $groups->sum('students_end_count');
                    $totalRevenue  = (int) $groups->sum(fn (Group $g) => $g->revenue());

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
        });
    }
}
