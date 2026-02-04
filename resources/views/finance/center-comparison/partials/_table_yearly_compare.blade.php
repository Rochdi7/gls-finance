{{-- 
    Yearly comparison table (used for yoy_auto and years_between)
    Expects: $rows, $yearFrom, $yearTo
--}}

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Comparaison Annuelle - {{ $yearFrom }} vs {{ $yearTo }}</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-sm mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-start">Centre</th>
                            <th class="text-start">Ville</th>
                            <th colspan="3" class="text-center">{{ $yearFrom }}</th>
                            <th colspan="3" class="text-center">{{ $yearTo }}</th>
                            <th colspan="2" class="text-center">Croissance</th>
                            <th class="text-center">État</th>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th class="text-end">Attendu (DH)</th>
                            <th class="text-end">Encaissé (DH)</th>
                            <th class="text-center">Taux %</th>
                            <th class="text-end">Attendu (DH)</th>
                            <th class="text-end">Encaissé (DH)</th>
                            <th class="text-center">Taux %</th>
                            <th class="text-center">Encaissé %</th>
                            <th class="text-center">Δ Taux</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rows as $row)
                            <tr>
                                <td class="text-start">
                                    <strong>{{ $row['center_name'] }}</strong>
                                </td>
                                <td class="text-start">
                                    {{ $row['city'] }}
                                </td>
                                <td class="text-end">
                                    {{ number_format($row['expected_from'] ?? 0, 2, ',', ' ') }}
                                </td>
                                <td class="text-end">
                                    {{ number_format($row['collected_from'] ?? 0, 2, ',', ' ') }}
                                </td>
                                <td class="text-center">
                                    {{ number_format(($row['collection_rate_from'] ?? 0) * 100, 1, ',', ' ') }}%
                                </td>
                                <td class="text-end">
                                    {{ number_format($row['expected_to'] ?? 0, 2, ',', ' ') }}
                                </td>
                                <td class="text-end">
                                    {{ number_format($row['collected_to'] ?? 0, 2, ',', ' ') }}
                                </td>
                                <td class="text-center">
                                    {{ number_format(($row['collection_rate_to'] ?? 0) * 100, 1, ',', ' ') }}%
                                </td>
                                <td class="text-center">
                                    @if (($row['yoy_collected_growth'] ?? 0) >= 0)
                                        <span class="text-success">
                                            +{{ number_format(($row['yoy_collected_growth'] ?? 0) * 100, 1, ',', ' ') }}%
                                        </span>
                                    @else
                                        <span class="text-danger">
                                            {{ number_format(($row['yoy_collected_growth'] ?? 0) * 100, 1, ',', ' ') }}%
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if (($row['yoy_rate_change'] ?? 0) >= 0)
                                        <span class="text-success">
                                            +{{ number_format(($row['yoy_rate_change'] ?? 0) * 100, 1, ',', ' ') }}%
                                        </span>
                                    @else
                                        <span class="text-danger">
                                            {{ number_format(($row['yoy_rate_change'] ?? 0) * 100, 1, ',', ' ') }}%
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @include('finance.center-comparison.partials._etat_badge', [
                                        'etat' => $row['etat_year'],
                                    ])
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center text-muted py-4">
                                    Aucune donnée disponible pour les filtres sélectionnés.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
