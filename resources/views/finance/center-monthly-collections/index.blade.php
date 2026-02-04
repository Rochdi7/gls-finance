@extends('layouts.default')

@php
    $page_title = 'Finance · Paiements mensuels des centres';

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
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Paiements mensuels des centres</h4>

                    <a href="{{ route('finance.center-monthly-collections.create') }}" class="btn btn-primary">
                        + Ajouter un paiement
                    </a>
                </div>

                <div class="card-body">

                    {{-- ✅ Filtres --}}
                    <form method="GET" action="{{ route('finance.center-monthly-collections.index') }}"
                        class="row g-3 mb-3">
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

                        <div class="col-md-4">
                            <label class="form-label">Centre</label>
                            <select name="center_id" class="form-control">
                                <option value="">Tous les centres</option>
                                @foreach ($centers as $c)
                                    <option value="{{ $c->id }}" @selected((string) $centerId === (string) $c->id)>
                                        {{ $c->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2 d-flex align-items-end gap-2">
                            <button class="btn btn-primary w-100" type="submit">Filtrer</button>
                            <a class="btn btn-light w-100"
                                href="{{ route('finance.center-monthly-collections.index') }}">Réinitialiser</a>
                        </div>
                    </form>

                    @include('finance.center-monthly-collections._table')

                </div>
            </div>

        </div>
    </div>
@endsection
