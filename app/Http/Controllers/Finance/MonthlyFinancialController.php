<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Http\Requests\Finance\MonthlyFinancial\MonthlyFinancialStoreRequest;
use App\Http\Requests\Finance\MonthlyFinancial\MonthlyFinancialUpdateRequest;
use App\Models\Center;
use App\Models\MonthlyFinancial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MonthlyFinancialController extends Controller
{
    public function index(Request $request): View
    {
        $year = (int) $request->get('year', now()->year);

        $items = MonthlyFinancial::query()
            ->with('center')
            ->where('year', $year)
            ->orderByDesc('year')
            ->orderByDesc('month')
            ->paginate(25)
            ->withQueryString();

        $availableYears = MonthlyFinancial::query()
            ->select('year')
            ->distinct()
            ->orderByDesc('year')
            ->pluck('year');

        // ✅ dossier views: resources/views/finance/monthly-financials/...
        return view('finance.monthly-financials.index', compact('items', 'year', 'availableYears'));
    }

    public function create(): View
    {
        $centers = Center::query()->orderBy('name')->get();

        return view('finance.monthly-financials.create', compact('centers'));
    }

    public function store(MonthlyFinancialStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // ✅ auto-split si non envoyé
        $totalRevenue = (int) ($data['total_revenue'] ?? 0);

        if (!array_key_exists('owner_share_50', $data) || $data['owner_share_50'] === null) {
            $data['owner_share_50'] = (int) round($totalRevenue * 0.50);
        }

        if (!array_key_exists('professors_share_35', $data) || $data['professors_share_35'] === null) {
            $data['professors_share_35'] = (int) round($totalRevenue * 0.35);
        }

        if (!array_key_exists('other_costs_15', $data) || $data['other_costs_15'] === null) {
            $data['other_costs_15'] = (int) ($totalRevenue - $data['owner_share_50'] - $data['professors_share_35']);
        }

        $mf = MonthlyFinancial::create($data);

        return redirect()
            // ✅ resource: monthly-financials => name: finance.monthly-financials.*
            ->route('finance.monthly-financials.index', ['year' => $mf->year])
            ->with('toast', [
                'title'   => 'Création réussie',
                'message' => "Le résumé {$mf->month}/{$mf->year} a été créé.",
                'dot'     => 'success',
                'delay'   => 4500,
                'time'    => now()->format('H:i'),
            ]);
    }

    public function show(MonthlyFinancial $monthly_financial): View
    {
        $monthly_financial->load('center');

        return view('finance.monthly-financials.show', compact('monthly_financial'));
    }

    public function edit(MonthlyFinancial $monthly_financial): View
    {
        $monthly_financial->load('center');
        $centers = Center::query()->orderBy('name')->get();

        return view('finance.monthly-financials.edit', compact('monthly_financial', 'centers'));
    }

    public function update(MonthlyFinancialUpdateRequest $request, MonthlyFinancial $monthly_financial): RedirectResponse
    {
        // ✅ Request bloque déjà si locked
        $data = $request->validated();

        $totalRevenue = (int) ($data['total_revenue'] ?? 0);

        if (!array_key_exists('owner_share_50', $data) || $data['owner_share_50'] === null) {
            $data['owner_share_50'] = (int) round($totalRevenue * 0.50);
        }

        if (!array_key_exists('professors_share_35', $data) || $data['professors_share_35'] === null) {
            $data['professors_share_35'] = (int) round($totalRevenue * 0.35);
        }

        if (!array_key_exists('other_costs_15', $data) || $data['other_costs_15'] === null) {
            $data['other_costs_15'] = (int) ($totalRevenue - $data['owner_share_50'] - $data['professors_share_35']);
        }

        $monthly_financial->update($data);

        return redirect()
            ->route('finance.monthly-financials.index', ['year' => $monthly_financial->year])
            ->with('toast', [
                'title'   => 'Mise à jour',
                'message' => "Le résumé {$monthly_financial->month}/{$monthly_financial->year} a été mis à jour.",
                'dot'     => 'info',
                'delay'   => 4500,
                'time'    => now()->format('H:i'),
            ]);
    }

    public function destroy(MonthlyFinancial $monthly_financial): RedirectResponse
    {
        if ($monthly_financial->locked) {
            return back()->with('toast', [
                'title'   => 'Action refusée',
                'message' => 'Ce mois est verrouillé. Suppression interdite.',
                'dot'     => 'danger',
                'delay'   => 4500,
                'time'    => now()->format('H:i'),
            ]);
        }

        $year = $monthly_financial->year;
        $monthly_financial->delete();

        return redirect()
            ->route('finance.monthly-financials.index', ['year' => $year])
            ->with('toast', [
                'title'   => 'Suppression',
                'message' => 'Le résumé mensuel a été supprimé.',
                'dot'     => 'warning',
                'delay'   => 4500,
                'time'    => now()->format('H:i'),
            ]);
    }
}
