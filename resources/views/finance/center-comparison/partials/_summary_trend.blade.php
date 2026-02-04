{{-- 
    Summary cards for trend_multi_year mode
    Expects: $rows, $trendSummary
--}}

@if ($rows->count() > 0)
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h6 class="card-title mb-2">Nombre d'années</h6>
                    <h3 class="mb-0">{{ $rows->count() }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h6 class="card-title mb-2">Meilleur Encaissement</h6>
                    <h3 class="mb-0">
                        {{ number_format($trendSummary['best_collected_ever'] ?? 0, 2, ',', ' ') }} DH
                    </h3>
                    @if ($trendSummary['best_year'])
                        <small class="text-muted">Année {{ $trendSummary['best_year'] }}</small>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h6 class="card-title mb-2">Taux Moyen</h6>
                    @php
                        $avgRate = $rows->count() > 0 ? ($rows->sum('collection_rate_year') / $rows->count()) * 100 : 0;
                    @endphp
                    <h3 class="mb-0">{{ number_format($avgRate, 1, ',', ' ') }}%</h3>
                </div>
            </div>
        </div>
    </div>
@endif
