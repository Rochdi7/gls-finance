@extends('layouts.default')

@php
    $page_title = 'Finances mensuelles';
@endphp

@section('content')
<div class="container-fluid">

    <div class="d-flex align-items-center mb-4 flex-wrap">
        <h3 class="me-auto">Finances mensuelles</h3>

        <div class="d-flex align-items-center flex-wrap gap-2">
            <form method="GET" action="{{ route('finance.monthly-financials.index') }}" class="d-flex align-items-center">
                <select name="year" class="default-select form-control me-2" onchange="this.form.submit()">
                    @foreach($availableYears as $y)
                        <option value="{{ $y }}" @selected((int)$y === (int)$year)>{{ $y }}</option>
                    @endforeach
                </select>
            </form>

            <a href="{{ route('finance.monthly-financials.create') }}" class="btn btn-primary me-2">
                <i class="fas fa-plus me-2"></i>Ajouter
            </a>

            <a href="javascript:void(0);" class="icon-btn me-2"><i class="fas fa-envelope"></i></a>
            <a href="javascript:void(0);" class="icon-btn me-2"><i class="fas fa-phone-alt"></i></a>
            <a href="javascript:void(0);" class="icon-btn"><i class="fas fa-info"></i></a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            {{-- ✅ le controller envoie $items --}}
            @include('finance.monthly-financials._table', ['rows' => $items])
        </div>
    </div>

</div>
@endsection
