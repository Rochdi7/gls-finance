<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Http\Requests\Finance\Professor\ProfessorStoreRequest;
use App\Http\Requests\Finance\Professor\ProfessorUpdateRequest;
use App\Models\Professor;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProfessorController extends Controller
{
    public function index(): View
    {
        $professors = Professor::query()
            ->latest()
            ->paginate(20);

        return view('finance.professors.index', compact('professors'));
    }

    public function create(): View
    {
        return view('finance.professors.create');
    }

    public function store(ProfessorStoreRequest $request): RedirectResponse
    {
        $professor = Professor::create($request->validated());

        return redirect()
            ->route('finance.professors.index')
            ->with('toast', [
                'title' => 'Création réussie',
                'message' => "Le professeur « {$professor->name} » a été créé.",
                'dot' => 'success',
                'delay' => 4500,
                'time' => now()->format('H:i'),
            ]);
    }

    public function show(Professor $professor): View
    {
        return view('finance.professors.show', compact('professor'));
    }

    public function edit(Professor $professor): View
    {
        return view('finance.professors.edit', compact('professor'));
    }

    public function update(ProfessorUpdateRequest $request, Professor $professor): RedirectResponse
    {
        $professor->update($request->validated());

        return redirect()
            ->route('finance.professors.index')
            ->with('toast', [
                'title' => 'Mise à jour',
                'message' => "Le professeur « {$professor->name} » a été mis à jour.",
                'dot' => 'info',
                'delay' => 4500,
                'time' => now()->format('H:i'),
            ]);
    }

    public function destroy(Professor $professor): RedirectResponse
    {
        $name = $professor->name;
        $professor->delete();

        return redirect()
            ->route('finance.professors.index')
            ->with('toast', [
                'title' => 'Suppression',
                'message' => "Le professeur « {$name} » a été supprimé.",
                'dot' => 'warning',
                'delay' => 4500,
                'time' => now()->format('H:i'),
            ]);
    }
}
