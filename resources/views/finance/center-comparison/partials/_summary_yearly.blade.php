{{-- 
    Summary cards for yoy_auto/years_between modes
    Expects: $rows, $yearFrom, $yearTo
--}}

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h6 class="card-title mb-2">Nombre de centres</h6>
                <h3 class="mb-0">{{ $rows->count() }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h6 class="card-title mb-2">Comparaison</h6>
                <p class="mb-0">{{ $yearFrom }} vs {{ $yearTo }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h6 class="card-title mb-2">Croissance Moyenne</h6>
                @php
                    $avgGrowth = $rows->count() > 0 ? ($rows->sum('yoy_collected_growth') / $rows->count()) * 100 : 0;
                @endphp
                <h3 class="mb-0">{{ number_format($avgGrowth, 1, ',', ' ') }}%</h3>
            </div>
        </div>
    </div>
</div>
