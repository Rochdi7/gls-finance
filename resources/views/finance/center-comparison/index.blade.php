@php
    $page_title = 'Comparaison Centres';
@endphp

@extends('layouts.default')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex align-items-center mb-4 flex-wrap">
            <h3 class="me-auto">Comparaison des Revenus par Centre</h3>
        </div>

        <!-- Error Message (if any) -->
        @if (isset($errorMessage))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                {{ $errorMessage }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Filters Section -->
        @include('finance.center-comparison.partials._filters', [
            'type' => $type,
            'mode' => $mode ?? null,
            'availableYears' => $availableYears,
            'centers' => $centers,
            'centerId' => $centerId ?? null,
            'year' => $year ?? null,
            'yearFrom' => $yearFrom ?? null,
            'yearTo' => $yearTo ?? null,
            'minRate' => $minRate ?? null,
        ])

        <!-- Type-Based Content -->
        @if ($type === 'monthly_year')
            {{-- Monthly Year Breakdown --}}
            @include('finance.center-comparison.partials._summary_monthly', [
                'rows' => $rows,
                'summary' => $summary ?? null,
            ])
            @include('finance.center-comparison.partials._table_monthly', [
                'rows' => $rows,
                'monthNames' => $monthNames,
                'year' => $year,
            ])
        @elseif ($type === 'yoy_auto' || $type === 'years_between')
            {{-- Yearly Comparison (YoY or Between) --}}
            @include('finance.center-comparison.partials._summary_yearly', [
                'rows' => $rows,
                'yearFrom' => $type === 'yoy_auto' ? $year : $yearFrom,
                'yearTo' => $type === 'yoy_auto' ? $year - 1 : $yearTo,
            ])
            @include('finance.center-comparison.partials._table_yearly_compare', [
                'rows' => $rows,
                'yearFrom' => $type === 'yoy_auto' ? $year : $yearFrom,
                'yearTo' => $type === 'yoy_auto' ? $year - 1 : $yearTo,
            ])
        @elseif ($type === 'trend_multi_year')
            {{-- Multi-Year Trend --}}
            @include('finance.center-comparison.partials._summary_trend', [
                'rows' => $rows,
                'trendSummary' => $trendSummary ?? [],
            ])
            @include('finance.center-comparison.partials._table_trend', [
                'rows' => $rows,
                'trendSummary' => $trendSummary ?? [],
            ])
        @elseif ($type === 'ranking_year')
            {{-- Ranking for Primes --}}
            @include('finance.center-comparison.partials._summary_ranking', ['rows' => $rows])
            @include('finance.center-comparison.partials._table_ranking', [
                'rows' => $rows,
                'year' => $year,
            ])
        @else
            {{-- Invalid Type --}}
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i>
                Type de comparaison invalide.
            </div>
        @endif

        <!-- Charts and Future Enhancements -->
        @include('finance.center-comparison.partials._charts_scripts')
    </div>
@endsection
