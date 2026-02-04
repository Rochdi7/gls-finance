<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Http\Requests\Finance\Center\CenterStoreRequest;
use App\Http\Requests\Finance\Center\CenterUpdateRequest;
use App\Models\Center;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\CenterMonthlyCollection;
use Illuminate\Http\Request;

class CenterController extends Controller
{
    public function index(): View
    {
        $centers = Center::query()->latest()->paginate(20);

        return view('finance.centers.index', compact('centers'));
    }

    public function create(): View
    {
        return view('finance.centers.create');
    }

    public function store(CenterStoreRequest $request): RedirectResponse
    {
        $center = Center::create($request->validated());

        return redirect()
            ->route('finance.centers.index')
            ->with('toast', [
                'title' => 'Création réussie',
                'message' => "Le centre « {$center->name} » a été créé avec succès.",
                'dot' => 'success',
                'delay' => 4500,
                'time' => now()->format('H:i'),
            ]);
    }

    public function show(Center $center)
{
    return redirect()->route('finance.center-monthly-collections.show-center', $center);
}


    public function edit(Center $center): View
    {
        return view('finance.centers.edit', compact('center'));
    }

    public function update(CenterUpdateRequest $request, Center $center): RedirectResponse
    {
        $center->update($request->validated());

        return redirect()
            ->route('finance.centers.index')
            ->with('toast', [
                'title' => 'Mise à jour effectuée',
                'message' => "Le centre « {$center->name} » a été mis à jour avec succès.",
                'dot' => 'info',
                'delay' => 4500,
                'time' => now()->format('H:i'),
            ]);
    }

    public function destroy(Center $center): RedirectResponse
    {
        $name = $center->name;
        $center->delete();

        return redirect()
            ->route('finance.centers.index')
            ->with('toast', [
                'title' => 'Suppression effectuée',
                'message' => "Le centre « {$name} » a été supprimé avec succès.",
                'dot' => 'warning',
                'delay' => 4500,
                'time' => now()->format('H:i'),
            ]);
    }

    
}
