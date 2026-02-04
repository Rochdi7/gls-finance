<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Http\Requests\Finance\Group\GroupStoreRequest;
use App\Http\Requests\Finance\Group\GroupUpdateRequest;
use App\Models\Center;
use App\Models\Group;
use App\Models\GroupMonthlyStat;
use App\Models\Professor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class GroupController extends Controller
{
    public function index(Request $request): View
    {
        $year        = (int) $request->get('year', now()->year);
        $month       = $request->filled('month') ? (int) $request->get('month') : null;
        $centerId    = $request->filled('center_id') ? (int) $request->get('center_id') : null;
        $professorId = $request->filled('professor_id') ? (int) $request->get('professor_id') : null;

        $query = Group::query()
            ->with(['center', 'professor'])
            ->where('year', $year);

        if (!is_null($month)) {
            $query->where('month', $month);
        }
        if (!is_null($centerId)) {
            $query->where('center_id', $centerId);
        }
        if (!is_null($professorId)) {
            $query->where('professor_id', $professorId);
        }

        $groups = $query
            ->orderByDesc('year')
            ->orderByDesc('month')
            ->paginate(25)
            ->withQueryString();

        $availableYears = Group::query()
            ->select('year')
            ->distinct()
            ->orderByDesc('year')
            ->pluck('year');

        $centers = Center::query()->orderBy('name')->get(['id', 'name']);
        $professors = Professor::query()->orderBy('name')->get(['id', 'name']);

        return view('finance.groups.index', compact(
            'groups',
            'year',
            'month',
            'centerId',
            'professorId',
            'availableYears',
            'centers',
            'professors'
        ));
    }

    public function create(): View
    {
        $centers = Center::query()->orderBy('name')->get();
        $professors = Professor::query()->orderBy('name')->get();
        $levels = Group::LEVELS;

        return view('finance.groups.create', compact('centers', 'professors', 'levels'));
    }

    public function store(GroupStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();

        return DB::transaction(function () use ($data) {
            $stats = collect($data['stats'] ?? [])->sortBy('month')->values();

            if ($stats->isEmpty()) {
                return back()
                    ->withErrors(['stats' => 'Ajoute au moins un mois.'])
                    ->withInput();
            }

            // ✅ Empêcher mois dupliqués côté controller (sécurité supplémentaire)
            $months = $stats->pluck('month')->map(fn ($m) => (int) $m)->all();
            if (count($months) !== count(array_unique($months))) {
                return back()
                    ->withErrors(['stats' => 'Chaque mois ne peut apparaître qu’une seule fois.'])
                    ->withInput();
            }

            $first = $stats->first();

            $month = (int) $first['month']; // ✅ Mois identitaire du groupe (index unique)
            $start = (int) $first['students_start_count'];
            $end   = (int) $first['students_end_count'];
            $price = (int) $first['price_per_student'];

            $centerName = Center::query()->whereKey($data['center_id'])->value('name') ?? 'Centre';
            $m = str_pad((string) $month, 2, '0', STR_PAD_LEFT);
            $name = "{$data['level_code']} – {$centerName} – {$m}/{$data['year']}";

            if (empty($name)) {
                return back()
                    ->withErrors(['center_id' => 'Impossible de générer le nom du groupe.'])
                    ->withInput();
            }

            // ✅ IMPORTANT : ici la contrainte unique peut bloquer si groupe existe déjà.
            $group = Group::create([
                'center_id'            => $data['center_id'],
                'professor_id'         => $data['professor_id'] ?? null,
                'name'                 => $name,
                'level_code'           => $data['level_code'],
                'students_start_count' => $start,
                'students_end_count'   => $end,
                'price_per_student'    => $price,
                'month'                => $month,
                'year'                 => (int) $data['year'],
                'status'               => $data['group_status'] ?? 'active',
            ]);

            foreach ($stats as $row) {
                $revenue = (int) $row['students_end_count'] * (int) $row['price_per_student'];

                GroupMonthlyStat::updateOrCreate(
                    [
                        'group_id' => $group->id,
                        'month'    => (int) $row['month'],
                        'year'     => (int) $group->year,
                    ],
                    [
                        'students_start_count' => (int) $row['students_start_count'],
                        'students_end_count'   => (int) $row['students_end_count'],
                        'revenue'              => $revenue,
                    ]
                );
            }

            return redirect()
                ->route('finance.groups.index', ['year' => $group->year])
                ->with('toast', [
                    'title' => 'Création réussie',
                    'message' => "Le groupe « {$group->name} » a été créé avec ses snapshots mensuels.",
                    'dot' => 'success',
                    'delay' => 4500,
                    'time' => now()->format('H:i'),
                ]);
        });
    }

    public function show(Group $group): View
    {
        $group->load(['center', 'professor', 'monthlyStats']);

        return view('finance.groups.show', compact('group'));
    }

    public function edit(Group $group): View
    {
        $group->load(['center', 'professor', 'monthlyStats']);

        $centers = Center::query()->orderBy('name')->get();
        $professors = Professor::query()->orderBy('name')->get();
        $levels = Group::LEVELS;

        return view('finance.groups.edit', compact('group', 'centers', 'professors', 'levels'));
    }

    public function update(GroupUpdateRequest $request, Group $group): RedirectResponse
    {
        $data = $request->validated();

        return DB::transaction(function () use ($data, $group) {

            $stats = collect($data['stats'] ?? [])->sortBy('month')->values();

            if ($stats->isEmpty()) {
                return back()
                    ->withErrors(['stats' => 'Ajoute au moins un mois.'])
                    ->withInput();
            }

            // ✅ sécurité: pas de mois dupliqués
            $months = $stats->pluck('month')->map(fn ($m) => (int) $m)->all();
            if (count($months) !== count(array_unique($months))) {
                return back()
                    ->withErrors(['stats' => 'Chaque mois ne peut apparaître qu’une seule fois.'])
                    ->withInput();
            }

            // ✅ 1) Update group global status uniquement
            $group->status = $data['group_status'] ?? $group->status;

            /**
             * ✅ 2) IMPORTANT: NE PAS TOUCHER $group->month en update
             * Sinon tu déclenches le Duplicate entry sur groups_unique_per_month.
             *
             * On met juste à jour un résumé (optionnel) depuis le premier snapshot,
             * mais on garde group->month FIXE (mois identitaire).
             */
            $first = $stats->first();
            $group->students_start_count = (int) $first['students_start_count'];
            $group->students_end_count   = (int) $first['students_end_count'];
            $group->price_per_student    = (int) $first['price_per_student'];

            // ✅ 3) Name: basé sur group->month (stable)
            if (array_key_exists('name', $data) && empty($data['name'])) {
                $centerName = Center::query()->whereKey($group->center_id)->value('name') ?? 'Centre';
                $m = str_pad((string) $group->month, 2, '0', STR_PAD_LEFT);
                $group->name = "{$group->level_code} – {$centerName} – {$m}/{$group->year}";
            } elseif (!empty($data['name'] ?? null)) {
                $group->name = $data['name'];
            }

            $group->save();

            // ✅ 4) Sync monthly stats
            $existing = $group->monthlyStats()->get()->keyBy('id');
            $keptIds = [];

            foreach ($stats as $row) {
                $rowId = isset($row['id']) ? (int) $row['id'] : null;
                $month = (int) $row['month'];

                // ✅ Revenue calculée
                $revenue = (int) $row['students_end_count'] * (int) $row['price_per_student'];

                if ($rowId && $existing->has($rowId)) {
                    // update
                    $existing[$rowId]->update([
                        'month' => $month,
                        'year'  => (int) $group->year,
                        'students_start_count' => (int) $row['students_start_count'],
                        'students_end_count'   => (int) $row['students_end_count'],
                        'revenue' => $revenue,
                    ]);
                    $keptIds[] = $rowId;
                } else {
                    // ✅ IMPORTANT: éviter doublon group_id/month/year
                    // si tu ajoutes un mois déjà existant mais sans id
                    $found = GroupMonthlyStat::query()
                        ->where('group_id', $group->id)
                        ->where('month', $month)
                        ->where('year', (int) $group->year)
                        ->first();

                    if ($found) {
                        $found->update([
                            'students_start_count' => (int) $row['students_start_count'],
                            'students_end_count'   => (int) $row['students_end_count'],
                            'revenue' => $revenue,
                        ]);
                        $keptIds[] = $found->id;
                    } else {
                        $new = GroupMonthlyStat::create([
                            'group_id' => $group->id,
                            'month' => $month,
                            'year'  => (int) $group->year,
                            'students_start_count' => (int) $row['students_start_count'],
                            'students_end_count'   => (int) $row['students_end_count'],
                            'revenue' => $revenue,
                        ]);
                        $keptIds[] = $new->id;
                    }
                }
            }

            // delete removed
            $group->monthlyStats()
                ->whereNotIn('id', $keptIds)
                ->delete();

            return redirect()
                ->route('finance.groups.index', ['year' => $group->year])
                ->with('toast', [
                    'title' => 'Mise à jour',
                    'message' => "Le groupe « {$group->name} » a été mis à jour (snapshots synchronisés).",
                    'dot' => 'info',
                    'delay' => 4500,
                    'time' => now()->format('H:i'),
                ]);
        });
    }

    public function destroy(Group $group): RedirectResponse
    {
        $year  = $group->year;
        $label = $group->name ?: "#{$group->id}";

        $group->delete();

        return redirect()
            ->route('finance.groups.index', ['year' => $year])
            ->with('toast', [
                'title'   => 'Suppression',
                'message' => "Le groupe « {$label} » a été supprimé.",
                'dot'     => 'warning',
                'delay'   => 4500,
                'time'    => now()->format('H:i'),
            ]);
    }
}
