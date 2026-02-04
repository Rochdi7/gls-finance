@extends('layouts.default')

@php
    $page_title = 'Finance · Paiements des centres';

    $monthNames = [
        1 => 'Janvier',
        2 => 'Février',
        3 => 'Mars',
        4 => 'Avril',
        5 => 'Mai',
        6 => 'Juin',
        7 => 'Juillet',
        8 => 'Août',
        9 => 'Septembre',
        10 => 'Octobre',
        11 => 'Novembre',
        12 => 'Décembre',
    ];
@endphp

@section('content')
    <div class="container-fluid">

        {{-- ✅ EN-TÊTE (pas grand espace vide) --}}
        <div class="d-flex align-items-start justify-content-between mb-4 flex-wrap">
            <div>
                <h4 class="mb-1">{{ $center->name }}</h4>
                <div class="text-muted">
                    Ville : {{ $center->city ?? '-' }}
                    • Statut :
                    @if ($center->active)
                        <span class="badge badge-success badge-lg light">Actif</span>
                    @else
                        <span class="badge badge-danger badge-lg light">Inactif</span>
                    @endif
                </div>
            </div>

            <div class="d-flex flex-wrap gap-2 mt-2 mt-md-0">
                <a href="{{ route('finance.centers.index') }}" class="btn btn-light">Retour</a>
                <a href="{{ route('finance.centers.edit', $center) }}" class="btn btn-secondary">Modifier le centre</a>
                <a href="{{ route('finance.center-monthly-collections.create', ['center_id' => $center->id]) }}"
                    class="btn btn-primary">
                    + Ajouter un paiement
                </a>
            </div>
        </div>

        {{-- ✅ FILTRES EN PREMIER --}}
        <div class="card mb-3">
            <div class="card-body">

                <form method="GET" action="{{ route('finance.center-monthly-collections.show-center', $center) }}"
                    class="row g-3">

                    <div class="col-md-3">
                        <label class="form-label">Année</label>
                        <select name="year" class="form-control">
                            <option value="">Toutes les années</option>
                            @foreach ($availableYears as $y)
                                <option value="{{ $y }}" @selected((string) $year === (string) $y)>{{ $y }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Mois</label>
                        <select name="month" class="form-control">
                            <option value="">Tous les mois</option>
                            @foreach ($monthNames as $m => $label)
                                <option value="{{ $m }}" @selected((string) $month === (string) $m)>{{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 d-flex align-items-end">
                        <button class="btn btn-primary w-100" type="submit">Filtrer</button>
                    </div>

                    <div class="col-md-3 d-flex align-items-end">
                        <a class="btn btn-light w-100"
                            href="{{ route('finance.center-monthly-collections.show-center', $center) }}">
                            Réinitialiser
                        </a>
                    </div>
                </form>

                {{-- ✅ totaux --}}
                <div class="row mt-3">
                    <div class="col-md-2 mb-2">
                        <div class="p-2 border rounded">
                            <div class="text-muted small">Espèces</div>
                            <div class="fw-bold">{{ number_format($totals->cash_sum ?? 0, 2) }}</div>
                        </div>
                    </div>

                    <div class="col-md-2 mb-2">
                        <div class="p-2 border rounded">
                            <div class="text-muted small">TPE</div>
                            <div class="fw-bold">{{ number_format($totals->tpe_sum ?? 0, 2) }}</div>
                        </div>
                    </div>

                    <div class="col-md-3 mb-2">
                        <div class="p-2 border rounded">
                            <div class="text-muted small">Virement bancaire</div>
                            <div class="fw-bold">{{ number_format($totals->bank_sum ?? 0, 2) }}</div>
                        </div>
                    </div>

                    <div class="col-md-2 mb-2">
                        <div class="p-2 border rounded">
                            <div class="text-muted small">Chèque</div>
                            <div class="fw-bold">{{ number_format($totals->cheque_sum ?? 0, 2) }}</div>
                        </div>
                    </div>

                    <div class="col-md-3 mb-2">
                        <div class="p-2 border rounded bg-light">
                            <div class="text-muted small">TOTAL</div>
                            <div class="fw-bold">{{ number_format($totals->total_sum ?? 0, 2) }}</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- ✅ TABLEAU APRÈS FILTRAGE --}}
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Paiements mensuels</h4>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="example4" class="table display mb-4 dataTablesCard">
                        <thead>
                            <tr>
                                <th>Année</th>
                                <th>Mois</th>
                                <th>Espèces</th>
                                <th>TPE</th>
                                <th>Virement</th>
                                <th>Chèque</th>
                                <th>Total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($collections as $row)
                                <tr>
                                    <td>{{ $row->year }}</td>
                                    <td>{{ $monthNames[$row->month] ?? $row->month }}</td>
                                    <td><strong>{{ number_format($row->cash_amount, 2) }}</strong></td>
                                    <td><strong>{{ number_format($row->tpe_amount, 2) }}</strong></td>
                                    <td><strong>{{ number_format($row->bank_transfer_amount, 2) }}</strong></td>
                                    <td><strong>{{ number_format($row->cheque_amount, 2) }}</strong></td>
                                    <td><strong>{{ number_format($row->total_amount, 2) }}</strong></td>
                                    <td class="text-end">
                                        <a href="{{ route('finance.center-monthly-collections.edit', $row) }}"
                                            class="btn btn-sm btn-primary">
                                            Modifier
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted">Aucun paiement trouvé.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
