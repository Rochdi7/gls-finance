@extends('layouts.default')

@php
    $page_title = 'Modifier finance mensuelle';
@endphp

@section('content')
<div class="container-fluid">

    <div class="mb-4">
        <h3>
            Modifier —
            {{ $monthly_financial->center->name }}
            ({{ str_pad($monthly_financial->month, 2, '0', STR_PAD_LEFT) }}/{{ $monthly_financial->year }})
        </h3>
    </div>

    @if ($monthly_financial->locked)
        <div class="alert alert-danger">
            Ce mois est verrouillé. Aucune modification n’est autorisée.
        </div>
    @else
        <form method="POST" action="{{ route('finance.monthly-financials.update', $monthly_financial) }}">
            @csrf
            @method('PUT')

            @include('finance.monthly-financials._form', [
                'monthly_financial' => $monthly_financial,
                'centers' => $centers
            ])

            <div class="text-end mt-4">
                <a href="{{ route('finance.monthly-financials.index', ['year' => $monthly_financial->year]) }}"
                   class="btn btn-secondary light me-3">
                    Retour
                </a>
                <button type="submit" class="btn btn-primary">
                    Mettre à jour
                </button>
            </div>
        </form>
    @endif

</div>
@endsection
