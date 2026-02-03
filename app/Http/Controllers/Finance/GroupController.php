<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Http\Requests\Finance\Group\GroupStoreRequest;
use App\Http\Requests\Finance\Group\GroupUpdateRequest;
use App\Models\Center;
use App\Models\Group;
use App\Models\Professor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GroupController extends Controller
{
    public function index(Request $request): View
    {
        $year  = (int) $request->get('year', now()->year);
        $month = $request->filled('month') ? (int) $request->get('month') : null;

        $query = Group::query()
            ->with(['center', 'professor'])
            ->where('year', $year);

        if ($month) {
            $query->where('month', $month);
        }

        $groups = $query
            ->orderByDesc('year')
            ->orderByDesc('month')
            ->paginate(25)
            ->withQueryString();

        // pour select filters
        $availableYears = Group::query()->select('year')->distinct()->orderByDesc('year')->pluck('year');
        $centers = Center::query()->orderBy('name')->get(['id', 'name']);
        $professors = Professor::query()->orderBy('name')->get(['id', 'name']);

        return view('finance.groups.index', compact('groups', 'year', 'month', 'availableYears', 'centers', 'professors'));
    }

    public function create(): View
    {
        $centers = Center::query()->orderBy('name')->get();
        $professors = Professor::query()->orderBy('name')->get();

        return view('finance.groups.create', compact('centers', 'professors'));
    }

    public function store(GroupStoreRequest $request): RedirectResponse
    {
        $group = Group::create($request->validated());

        return redirect()
            ->route('finance.groups.index', ['year' => $group->year])
            ->with('toast', [
                'title' => 'Création réussie',
                'message' => "Le groupe {$group->level_code} ({$group->month}/{$group->year}) a été créé.",
                'dot' => 'success',
                'delay' => 4500,
                'time' => now()->format('H:i'),
            ]);
    }

    public function show(Group $group): View
    {
        $group->load(['center', 'professor']);

        return view('finance.groups.show', compact('group'));
    }

    public function edit(Group $group): View
    {
        $centers = Center::query()->orderBy('name')->get();
        $professors = Professor::query()->orderBy('name')->get();

        return view('finance.groups.edit', compact('group', 'centers', 'professors'));
    }

    public function update(GroupUpdateRequest $request, Group $group): RedirectResponse
    {
        $group->update($request->validated());

        return redirect()
            ->route('finance.groups.index', ['year' => $group->year])
            ->with('toast', [
                'title' => 'Mise à jour',
                'message' => "Le groupe #{$group->id} a été mis à jour.",
                'dot' => 'info',
                'delay' => 4500,
                'time' => now()->format('H:i'),
            ]);
    }

    public function destroy(Group $group): RedirectResponse
    {
        $id = $group->id;
        $year = $group->year;

        $group->delete();

        return redirect()
            ->route('finance.groups.index', ['year' => $year])
            ->with('toast', [
                'title' => 'Suppression',
                'message' => "Le groupe #{$id} a été supprimé.",
                'dot' => 'warning',
                'delay' => 4500,
                'time' => now()->format('H:i'),
            ]);
    }
}
