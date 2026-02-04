{{-- 
    Summary cards for monthly_year mode
    Expects: $rows, $summary (optional)
--}}

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h6 class="card-title mb-2">Nombre de centres</h6>
                <h3 class="mb-0">{{ $rows->groupBy('center_id')->count() }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h6 class="card-title mb-2">Total Attendu</h6>
                <h3 class="mb-0">
                    {{ isset($summary['total_expected_year']) ? number_format($summary['total_expected_year'], 2, ',', ' ') : number_format($rows->sum('expected_revenue'), 2, ',', ' ') }}
                    DH
                </h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h6 class="card-title mb-2">Total Encaissé</h6>
                <h3 class="mb-0">
                    {{ isset($summary['total_collected_year']) ? number_format($summary['total_collected_year'], 2, ',', ' ') : number_format($rows->sum('collected_revenue'), 2, ',', ' ') }}
                    DH
                </h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h6 class="card-title mb-2">Taux Global</h6>
                @php
                    if (isset($summary['global_rate'])) {
                        $globalRate = $summary['global_rate'] * 100;
                    } else {
                        $totalExpected = $rows->sum('expected_revenue');
                        $totalCollected = $rows->sum('collected_revenue');
                        $globalRate = $totalExpected > 0 ? ($totalCollected / $totalExpected) * 100 : 0;
                    }
                @endphp
                <h3 class="mb-0">{{ number_format($globalRate, 1, ',', ' ') }}%</h3>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card text-center">
            <div class="card-body">
                <h6 class="card-title mb-2">Meilleur Mois</h6>
                <h3 class="mb-0 text-success">
                    {{ isset($summary['best_month_name']) ? $summary['best_month_name'] : 'N/A' }}
                </h3>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card text-center">
            <div class="card-body">
                <h6 class="card-title mb-2">Pire Mois</h6>
                <h3 class="mb-0 text-danger">
                    {{ isset($summary['worst_month_name']) ? $summary['worst_month_name'] : 'N/A' }}
                </h3>
            </div>
        </div>
    </div>
</div>
