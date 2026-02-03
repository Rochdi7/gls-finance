<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\Center;
use App\Models\Group;
use App\Models\Professor;
use Illuminate\Http\Request;
use Illuminate\View\View;

class YearlyFinanceController extends Controller
{
    public function index(Request $request): View
    {
        $year = (int) $request->get('year', now()->year);
        $centerId = $request->get('center_id'); // string|null

        // ✅ Centers pour le select
        $centers = Center::query()
            ->orderBy('name')
            ->get();

        // ✅ Available years (Collection ok)
        $availableYears = Group::query()
            ->select('year')
            ->distinct()
            ->orderBy('year')
            ->pluck('year')
            ->values();

        if ($availableYears->isEmpty()) {
            $availableYears = collect([$year]);
        }

        /**
         * ✅ Professors + groups filtrés année + (optionnel) centre
         * ✅ IMPORTANT: on filtre pour ne garder QUE les profs qui ont au moins 1 groupe (après filtres)
         */
        $professors = Professor::query()
            ->whereHas('groups', function ($q) use ($year, $centerId) {
                $q->where('year', $year)
                  ->when($centerId, fn ($qq) => $qq->where('center_id', $centerId));
            })
            ->orderBy('name')
            ->with(['groups' => function ($q) use ($year, $centerId) {
                $q->where('year', $year)
                    ->when($centerId, fn ($qq) => $qq->where('center_id', $centerId))
                    ->with('center')
                    ->orderBy('month')
                    ->orderBy('center_id');
            }])
            ->get();

        // ✅ Groupes non affectés (année + centre)
        $unassignedGroups = Group::query()
            ->where('year', $year)
            ->when($centerId, fn ($q) => $q->where('center_id', $centerId))
            ->whereNull('professor_id')
            ->with('center')
            ->orderBy('month')
            ->orderBy('center_id')
            ->get();

        // ✅ Totaux année (année + centre)
        $groupsOfYear = Group::query()
            ->where('year', $year)
            ->when($centerId, fn ($q) => $q->where('center_id', $centerId))
            ->get();

        $totalStart = (int) $groupsOfYear->sum('students_start_count');
        $totalEnd   = (int) $groupsOfYear->sum('students_end_count');

        $totals = [
            'groups_count'      => $groupsOfYear->count(),
            'students_start'    => $totalStart,
            'students_end'      => $totalEnd,
            'revenue'           => (int) $groupsOfYear->sum(fn ($g) => (int) $g->students_end_count * (int) $g->price_per_student),
            'retention_percent' => $totalStart > 0 ? round(($totalEnd / $totalStart) * 100, 2) : 0,
        ];

        return view('finance.yearly.index', compact(
            'year',
            'centerId',
            'centers',
            'availableYears',
            'professors',
            'unassignedGroups',
            'totals'
        ));
    }
}
