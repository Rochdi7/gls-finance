<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Http\Requests\Finance\CenterMonthlyCollection\CenterMonthlyCollectionStoreRequest;
use App\Http\Requests\Finance\CenterMonthlyCollection\CenterMonthlyCollectionUpdateRequest;
use App\Models\Center;
use App\Models\CenterMonthlyCollection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CenterMonthlyCollectionController extends Controller
{
    public function index(Request $request): View
    {
        // ✅ Filters
        $year     = $request->filled('year') ? (int) $request->get('year') : null;
        $month    = $request->filled('month') ? (int) $request->get('month') : null;
        $centerId = $request->filled('center_id') ? (int) $request->get('center_id') : null;

        // ✅ Centers for select
        $centers = Center::query()->orderBy('name')->get();

        // ✅ Available years
        $availableYears = CenterMonthlyCollection::query()
            ->select('year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->values();

        $query = CenterMonthlyCollection::query()->with('center');

        if ($year !== null) {
            $query->where('year', $year);
        }

        if ($month !== null) {
            $query->where('month', $month);
        }

        if ($centerId !== null) {
            $query->where('center_id', $centerId);
        }

        $collections = $query
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->paginate(20)
            ->withQueryString();

        return view('finance.center-monthly-collections.index', compact(
            'collections',
            'centers',
            'availableYears',
            'year',
            'month',
            'centerId'
        ));
    }

    public function create(Request $request): View
    {
        $centers = Center::query()->orderBy('name')->get();

        // ✅ preselect center from query string: ?center_id=1
        $defaultCenterId = $request->filled('center_id') ? (int) $request->get('center_id') : null;

        return view('finance.center-monthly-collections.create', compact('centers', 'defaultCenterId'));
    }

    public function store(CenterMonthlyCollectionStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $row = CenterMonthlyCollection::create($data);

        // ✅ redirect to show-center (Center model route binding)
        $center = Center::findOrFail($row->center_id);

        return redirect()
            ->route('finance.center-monthly-collections.show-center', $center)
            ->with('toast', [
                'title'   => 'Création réussie',
                'message' => 'Le paiement mensuel du centre a été ajouté avec succès.',
                'dot'     => 'success',
                'delay'   => 4500,
                'time'    => now()->format('H:i'),
            ]);
    }

    public function edit(CenterMonthlyCollection $centerMonthlyCollection): View
    {
        $centers = Center::query()->orderBy('name')->get();

        return view('finance.center-monthly-collections.edit', [
            'centers'    => $centers,
            'collection' => $centerMonthlyCollection,
        ]);
    }

    public function update(
        CenterMonthlyCollectionUpdateRequest $request,
        CenterMonthlyCollection $centerMonthlyCollection
    ): RedirectResponse {
        $data = $request->validated();

        $centerMonthlyCollection->update($data);

        // ✅ redirect to show-center (Center model route binding)
        $center = Center::findOrFail($centerMonthlyCollection->center_id);

        return redirect()
            ->route('finance.center-monthly-collections.show-center', $center)
            ->with('toast', [
                'title'   => 'Mise à jour réussie',
                'message' => 'Le paiement mensuel du centre a été mis à jour.',
                'dot'     => 'success',
                'delay'   => 4500,
                'time'    => now()->format('H:i'),
            ]);
    }

    public function destroy(CenterMonthlyCollection $centerMonthlyCollection): RedirectResponse
    {
        $center = Center::findOrFail($centerMonthlyCollection->center_id);

        $centerMonthlyCollection->delete();

        return redirect()
            ->route('finance.center-monthly-collections.show-center', $center)
            ->with('toast', [
                'title'   => 'Suppression réussie',
                'message' => 'Le paiement mensuel du centre a été supprimé.',
                'dot'     => 'success',
                'delay'   => 4500,
                'time'    => now()->format('H:i'),
            ]);
    }

    /**
     * ✅ SHOW payments of ONE center
     * IMPORTANT:
     * - year/month = null by default => show all
     * - use get() (not paginate) because theme uses DataTables
     */
    public function show(Request $request, Center $center): View
    {
        $year  = $request->filled('year') ? (int) $request->get('year') : null;
        $month = $request->filled('month') ? (int) $request->get('month') : null;

        // ✅ Years dropdown for this center
        $availableYears = CenterMonthlyCollection::query()
            ->where('center_id', $center->id)
            ->select('year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->values();

        // ✅ Base query (center + optional filters)
        $baseQuery = CenterMonthlyCollection::query()
            ->where('center_id', $center->id);

        if ($year !== null) {
            $baseQuery->where('year', $year);
        }

        if ($month !== null) {
            $baseQuery->where('month', $month);
        }

        // ✅ totals (no order)
        $totals = (clone $baseQuery)
            ->reorder()
            ->selectRaw('
                COALESCE(SUM(cash_amount),0) as cash_sum,
                COALESCE(SUM(tpe_amount),0) as tpe_sum,
                COALESCE(SUM(bank_transfer_amount),0) as bank_sum,
                COALESCE(SUM(cheque_amount),0) as cheque_sum,
                COALESCE(SUM(total_amount),0) as total_sum
            ')
            ->first();

        // ✅ DataTables needs all rows (no Laravel pagination)
        $collections = (clone $baseQuery)
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        return view('finance.center-monthly-collections.show', compact(
            'center',
            'collections',
            'availableYears',
            'year',
            'month',
            'totals'
        ));
    }
}
