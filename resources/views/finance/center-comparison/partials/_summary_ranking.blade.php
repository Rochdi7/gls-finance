{{-- 
    Summary cards for ranking_year mode
    Expects: $rows
--}}

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h6 class="card-title mb-2">Centres Classés</h6>
                <h3 class="mb-0">{{ $rows->count() }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h6 class="card-title mb-2">Score Moyen (Primes)</h6>
                @php
                    $avgScore = $rows->count() > 0 ? $rows->sum('score') / $rows->count() : 0;
                @endphp
                <h3 class="mb-0">{{ number_format($avgScore, 2, ',', ' ') }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h6 class="card-title mb-2">Taux Moyen</h6>
                @php
                    $avgRate = $rows->count() > 0 ? ($rows->sum('collection_rate_current') / $rows->count()) * 100 : 0;
                @endphp
                <h3 class="mb-0">{{ number_format($avgRate, 1, ',', ' ') }}%</h3>
            </div>
        </div>
    </div>
</div>
