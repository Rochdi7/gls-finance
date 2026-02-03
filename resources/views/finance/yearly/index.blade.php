{{-- C:\Users\ASUS\Desktop\Projects\gls-finance\resources\views\finance\yearly\index.blade.php --}}

@extends('layouts.default')

@php
    $page_title = 'Résumé annuel';

    // ✅ center_id depuis query string (si présent)
    $selectedCenterId = request('center_id');
@endphp

@section('content')
<div class="container-fluid">

    <div class="d-flex align-items-center mb-4 flex-wrap">
    @php
        // ✅ Valeur du filtre centre depuis l’URL
        $selectedCenterId = request('center_id');

        // ✅ $availableYears est une Collection (ou array) => min/max safe
        if ($availableYears instanceof \Illuminate\Support\Collection) {
            $minYear = (int) ($availableYears->min() ?? now()->year);
            $maxYear = (int) ($availableYears->max() ?? now()->year);
        } else {
            $minYear = (int) (min($availableYears ?? [now()->year]));
            $maxYear = (int) (max($availableYears ?? [now()->year]));
        }

        if ($minYear <= 0) $minYear = 2024;
        if ($maxYear <= 0) $maxYear = (int) now()->year;

        $yearsList = range($minYear, $maxYear);
    @endphp

    <div class="me-auto">
        <h3 class="mb-1">Résumé annuel</h3>
        <small class="text-muted">
            Année sélectionnée : <strong>{{ $year }}</strong>

            @if (!empty($selectedCenterId))
                @php
                    $selectedCenterName = optional($centers->firstWhere('id', (int) $selectedCenterId))->name;
                @endphp
                <span class="ms-2">| Centre : <strong>{{ $selectedCenterName ?? '—' }}</strong></span>
            @endif
        </small>
    </div>

    {{-- ✅ FILTERS: Year + Center --}}
    <form method="GET" action="{{ route('finance.yearly') }}" class="d-flex align-items-center gap-2">

        {{-- YEAR (display all years) --}}
        <select name="year" class="form-control default-select">
            @foreach ($yearsList as $y)
                <option value="{{ $y }}" @selected((int) $y === (int) $year)>{{ $y }}</option>
            @endforeach
        </select>

        {{-- CENTER --}}
        <select name="center_id" class="form-control default-select">
            <option value="">— Tous les centres —</option>
            @foreach ($centers as $c)
                <option value="{{ $c->id }}" @selected((string) $c->id === (string) $selectedCenterId)>
                    {{ $c->name }}
                </option>
            @endforeach
        </select>

        <button class="btn btn-primary" type="submit">
            Filtrer
        </button>

    </form>
</div>

    {{-- Totaux année --}}
    <div class="row mb-4">

        <div class="col-xl-3 col-md-6">
            <div class="card text-center">
                <div class="card-body">
                    <h6 class="mb-1">Groupes</h6>
                    <h3 class="mb-0">{{ (int) ($totals['groups_count'] ?? 0) }}</h3>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card text-center">
                <div class="card-body">
                    <h6 class="mb-1">Étudiants (début)</h6>
                    <h3 class="mb-0">{{ number_format((int) ($totals['students_start'] ?? 0)) }}</h3>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card text-center">
                <div class="card-body">
                    <h6 class="mb-1">Étudiants (fin)</h6>
                    <h3 class="mb-0">{{ number_format((int) ($totals['students_end'] ?? 0)) }}</h3>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card text-center">
                <div class="card-body">
                    <h6 class="mb-1">Rétention</h6>
                    <h3 class="mb-0">{{ number_format((float) ($totals['retention_percent'] ?? 0), 2) }}%</h3>
                </div>
            </div>
        </div>

        <div class="col-xl-12 mt-3">
            <div class="card">
                <div class="card-body d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <div>
                        <h6 class="mb-1">Revenu total (année)</h6>
                        <h3 class="mb-0">{{ number_format((int) ($totals['revenue'] ?? 0)) }} DH</h3>
                    </div>
                    <div class="text-muted">
                        Calcul : somme des revenus de tous les groupes (étudiants fin × prix).
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Groupes non affectés --}}
    <div class="row mb-4">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4 class="card-title mb-0">Groupes non affectés</h4>
                    <span class="badge badge-danger light">
                        {{ $unassignedGroups->count() }}
                    </span>
                </div>

                <div class="card-body">
                    @if ($unassignedGroups->isEmpty())
                        <div class="alert alert-success mb-0">
                            Aucun groupe non affecté pour {{ $year }}.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table display mb-0 dataTablesCard card-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Centre</th>
                                        <th>Mois</th>
                                        <th>Niveau</th>
                                        <th>Début</th>
                                        <th>Fin</th>
                                        <th>Prix</th>
                                        <th>Revenu</th>
                                        <th>Rétention</th>
                                        <th class="text-end">Voir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($unassignedGroups as $i => $g)
                                        @php
                                            $start = (int) $g->students_start_count;
                                            $end   = (int) $g->students_end_count;
                                            $rev   = (int) ($end * (int) $g->price_per_student);
                                            $ret   = $start > 0 ? round(($end / $start) * 100, 2) : 0;
                                        @endphp
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>{{ $g->center?->name ?? '—' }}</td>
                                            <td>{{ str_pad($g->month, 2, '0', STR_PAD_LEFT) }}/{{ $g->year }}</td>
                                            <td><span class="badge badge-info light">{{ $g->level_code }}</span></td>
                                            <td>{{ $start }}</td>
                                            <td>{{ $end }}</td>
                                            <td>{{ number_format((int) $g->price_per_student) }} DH</td>
                                            <td><strong>{{ number_format($rev) }} DH</strong></td>
                                            <td>{{ number_format($ret, 2) }}%</td>
                                            <td class="text-end">
                                                <a href="{{ route('finance.groups.show', $g) }}" class="btn btn-secondary light">
                                                    👁️
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>

    {{-- Professeurs --}}
    <div class="row">
        <div class="col-xl-12">

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Performance par professeur</h4>
                </div>

                <div class="card-body">
                    @if ($professors->isEmpty())
                        <div class="alert alert-warning mb-0">
                            Aucun professeur trouvé.
                        </div>
                    @else
                        <div class="accordion" id="accordionProfessors">
                            @foreach ($professors as $idx => $prof)
                                @php
                                    $groups = $prof->groups ?? collect();

                                    $pStart = (int) $groups->sum('students_start_count');
                                    $pEnd   = (int) $groups->sum('students_end_count');
                                    $pRev   = (int) $groups->sum(fn ($g) => (int) $g->students_end_count * (int) $g->price_per_student);
                                    $pRet   = $pStart > 0 ? round(($pEnd / $pStart) * 100, 2) : 0;
                                @endphp

                                <div class="accordion-item mb-3">
                                    <h2 class="accordion-header" id="heading-{{ $prof->id }}">
                                        <button class="accordion-button {{ $idx === 0 ? '' : 'collapsed' }}" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#collapse-{{ $prof->id }}"
                                            aria-expanded="{{ $idx === 0 ? 'true' : 'false' }}"
                                            aria-controls="collapse-{{ $prof->id }}">
                                            <div class="d-flex flex-wrap align-items-center gap-3 w-100">
                                                <div class="me-auto">
                                                    <strong>{{ $prof->name }}</strong>
                                                    <span class="text-muted ms-2">({{ $groups->count() }} groupes)</span>
                                                </div>

                                                <div class="d-flex flex-wrap gap-2">
                                                    <span class="badge badge-info light">
                                                        Début : {{ $pStart }}
                                                    </span>
                                                    <span class="badge badge-success light">
                                                        Fin : {{ $pEnd }}
                                                    </span>
                                                    <span class="badge badge-primary light">
                                                        Revenu : {{ number_format($pRev) }} DH
                                                    </span>
                                                    <span class="badge badge-warning light">
                                                        Rétention : {{ number_format($pRet, 2) }}%
                                                    </span>
                                                </div>
                                            </div>
                                        </button>
                                    </h2>

                                    <div id="collapse-{{ $prof->id }}"
                                         class="accordion-collapse collapse {{ $idx === 0 ? 'show' : '' }}"
                                         aria-labelledby="heading-{{ $prof->id }}"
                                         data-bs-parent="#accordionProfessors">
                                        <div class="accordion-body">

                                            @if ($groups->isEmpty())
                                                <div class="alert alert-secondary mb-0">
                                                    Aucun groupe attribué à ce professeur pour {{ $year }}.
                                                </div>
                                            @else
                                                <div class="table-responsive">
                                                    <table class="table display mb-0 dataTablesCard card-table">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Centre</th>
                                                                <th>Mois</th>
                                                                <th>Niveau</th>
                                                                <th>Début</th>
                                                                <th>Fin</th>
                                                                <th>Prix</th>
                                                                <th>Revenu</th>
                                                                <th>Rétention</th>
                                                                <th class="text-end">Voir</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($groups as $i => $g)
                                                                @php
                                                                    $start = (int) $g->students_start_count;
                                                                    $end   = (int) $g->students_end_count;
                                                                    $rev   = (int) ($end * (int) $g->price_per_student);
                                                                    $ret   = $start > 0 ? round(($end / $start) * 100, 2) : 0;
                                                                @endphp
                                                                <tr>
                                                                    <td>{{ $i + 1 }}</td>
                                                                    <td>{{ $g->center?->name ?? '—' }}</td>
                                                                    <td>{{ str_pad($g->month, 2, '0', STR_PAD_LEFT) }}/{{ $g->year }}</td>
                                                                    <td><span class="badge badge-info light">{{ $g->level_code }}</span></td>
                                                                    <td>{{ $start }}</td>
                                                                    <td>{{ $end }}</td>
                                                                    <td>{{ number_format((int) $g->price_per_student) }} DH</td>
                                                                    <td><strong>{{ number_format($rev) }} DH</strong></td>
                                                                    <td>{{ number_format($ret, 2) }}%</td>
                                                                    <td class="text-end">
                                                                        <a href="{{ route('finance.groups.show', $g) }}" class="btn btn-secondary light">
                                                                            👁️
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>

        </div>
    </div>

</div>
@endsection
