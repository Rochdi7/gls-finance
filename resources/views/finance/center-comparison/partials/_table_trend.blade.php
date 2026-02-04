{{-- 
    Multi-year trend table for a specific center
    Expects: $rows, $trendSummary
--}}

@if ($rows->count() > 0)
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Tendance Multi-Années - Centre #{{ $rows->first()['center_id'] ?? '' }}</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-sm mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="text-start">Année</th>
                                <th class="text-end">Attendu (DH)</th>
                                <th class="text-end">Encaissé (DH)</th>
                                <th class="text-end">Étudiants</th>
                                <th class="text-center">Taux Encaissement</th>
                                <th class="text-center">État</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rows as $row)
                                @php
                                    $isRecord =
                                        $row['collected_year'] >= ($trendSummary['best_collected_ever'] ?? 0) &&
                                        $row['year'] == ($trendSummary['best_year'] ?? null);
                                @endphp
                                <tr>
                                    <td class="text-start">
                                        <strong>
                                            {{ $row['year'] }}
                                            @if ($isRecord)
                                                <i class="fas fa-star text-warning ms-1"></i>
                                            @endif
                                        </strong>
                                    </td>
                                    <td class="text-end">
                                        {{ number_format($row['expected_year'], 2, ',', ' ') }}
                                    </td>
                                    <td class="text-end">
                                        {{ number_format($row['collected_year'], 2, ',', ' ') }}
                                    </td>
                                    <td class="text-end">
                                        {{ number_format($row['total_students'], 0) }}
                                    </td>
                                    <td class="text-center">
                                        {{ number_format($row['collection_rate_year'] * 100, 1, ',', ' ') }}%
                                    </td>
                                    <td class="text-center">
                                        @include('finance.center-comparison.partials._etat_badge', [
                                            'etat' => $row['etat_year'],
                                        ])
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        Aucune donnée disponible pour ce centre.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="alert alert-info">
        <i class="fas fa-info-circle me-2"></i>
        Aucune donnée disponible. Veuillez sélectionner un centre.
    </div>
@endif
