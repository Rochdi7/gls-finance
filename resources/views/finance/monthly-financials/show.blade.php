@extends('layouts.default')

@php
    $page_title = 'Détail financier mensuel';
@endphp

@section('content')
<div class="container-fluid">

    <div class="d-flex align-items-center mb-4 flex-wrap">
        <div class="me-auto">
            <h4 class="mb-1">
                {{ $monthly_financial->center->name ?? 'Centre' }} —
                {{ str_pad((int) $monthly_financial->month, 2, '0', STR_PAD_LEFT) }}/{{ $monthly_financial->year }}
            </h4>

            <div class="mt-2">
                @if($monthly_financial->locked)
                    <span class="badge badge-danger badge-lg light">Verrouillé</span>
                @else
                    <span class="badge badge-success badge-lg light">Modifiable</span>
                @endif

                @if($monthly_financial->is_historical)
                    <span class="badge badge-info badge-lg light ms-2">Historique</span>
                @else
                    <span class="badge badge-primary badge-lg light ms-2">Live</span>
                @endif
            </div>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('finance.monthly-financials.edit', $monthly_financial) }}" class="btn btn-secondary light">
                Modifier
            </a>

            @if(!$monthly_financial->locked)
                <form action="{{ route('finance.monthly-financials.destroy', $monthly_financial) }}" method="POST"
                      onsubmit="return confirm('Confirmer la suppression ?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger light" type="submit">Supprimer</button>
                </form>
            @endif
        </div>
    </div>

    <div class="row">

        <div class="col-xl-3 col-md-6">
            <div class="card text-center">
                <div class="card-body">
                    <h6>Étudiants</h6>
                    <h3 class="mb-0">{{ (int) $monthly_financial->total_students }}</h3>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card text-center">
                <div class="card-body">
                    <h6>Revenu total</h6>
                    <h3 class="mb-0">{{ number_format((int) $monthly_financial->total_revenue) }} DH</h3>
                </div>
            </div>
        </div>

        <div class="col-xl-2 col-md-6">
            <div class="card text-center">
                <div class="card-body">
                    <h6>Propriétaire (50%)</h6>
                    <h3 class="mb-0">{{ number_format((int) $monthly_financial->owner_share_50) }} DH</h3>
                </div>
            </div>
        </div>

        <div class="col-xl-2 col-md-6">
            <div class="card text-center">
                <div class="card-body">
                    <h6>Professeurs (35%)</h6>
                    <h3 class="mb-0">{{ number_format((int) $monthly_financial->professors_share_35) }} DH</h3>
                </div>
            </div>
        </div>

        <div class="col-xl-2 col-md-6">
            <div class="card text-center">
                <div class="card-body">
                    <h6>Charges (15%)</h6>
                    <h3 class="mb-0">{{ number_format((int) $monthly_financial->other_costs_15) }} DH</h3>
                </div>
            </div>
        </div>

    </div>

    <div class="mt-4">
        <a href="{{ route('finance.monthly-financials.index', ['year' => $monthly_financial->year]) }}"
           class="btn btn-secondary light">
            ← Retour
        </a>
    </div>

</div>
@endsection
