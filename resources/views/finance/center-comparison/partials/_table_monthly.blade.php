{{-- 
    Monthly breakdown table - shows months per center
    Expects: $rows, $monthNames, $year
--}}

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Comparaison Mensuelle - {{ $year }}</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-sm mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-start">Centre</th>
                            <th class="text-start">Ville</th>
                            <th class="text-start">Mois</th>
                            <th class="text-end">Étudiants</th>
                            <th class="text-end">Attendu (DH)</th>
                            <th class="text-end">Encaissé (DH)</th>
                            <th class="text-end">Écart (DH)</th>
                            <th class="text-center">Taux</th>
                            <th class="text-center">État</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            // Group rows by center for better display
                            $groupedByCenter = $rows->groupBy('center_id');

                            // Pre-calculate best and worst rate per center
                            $centerMetrics = [];
                            foreach ($groupedByCenter as $cid => $centerRows) {
                                $bestRate = -1;
                                $worstRate = 2;
                                $bestMonth = null;
                                $worstMonth = null;

                                foreach ($centerRows as $row) {
                                    if ($row['collection_rate'] > $bestRate) {
                                        $bestRate = $row['collection_rate'];
                                        $bestMonth = $row['month'];
                                    }
                                    if ($row['collection_rate'] < $worstRate) {
                                        $worstRate = $row['collection_rate'];
                                        $worstMonth = $row['month'];
                                    }
                                }

                                $centerMetrics[$cid] = [
                                    'best_month' => $bestMonth,
                                    'worst_month' => $worstMonth,
                                ];
                            }
                        @endphp

                        @forelse($groupedByCenter as $centerId => $centerRows)
                            @foreach ($centerRows->sortBy('month') as $row)
                                @php
                                    $isBestMonth = $centerMetrics[$centerId]['best_month'] === $row['month'];
                                    $isWorstMonth = $centerMetrics[$centerId]['worst_month'] === $row['month'];
                                    $rowClass = '';
                                    if ($isBestMonth) {
                                        $rowClass = 'table-success';
                                    } elseif ($isWorstMonth) {
                                        $rowClass = 'table-danger';
                                    }
                                @endphp
                                <tr class="{{ $rowClass }}">
                                    <td class="text-start">
                                        <strong>{{ $row['center_name'] }}</strong>
                                    </td>
                                    <td class="text-start">
                                        {{ $row['city'] }}
                                    </td>
                                    <td class="text-start">
                                        {{ $monthNames[$row['month']] ?? 'N/A' }}
                                    </td>
                                    <td class="text-end">
                                        {{ number_format($row['total_students'], 0) }}
                                    </td>
                                    <td class="text-end">
                                        {{ number_format($row['expected_revenue'], 2, ',', ' ') }}
                                    </td>
                                    <td class="text-end">
                                        {{ number_format($row['collected_revenue'], 2, ',', ' ') }}
                                    </td>
                                    <td class="text-end">
                                        @if ($row['variance'] >= 0)
                                            <span class="text-success">
                                                +{{ number_format($row['variance'], 2, ',', ' ') }}
                                            </span>
                                        @else
                                            <span class="text-danger">
                                                {{ number_format($row['variance'], 2, ',', ' ') }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{ number_format($row['collection_rate'] * 100, 1, ',', ' ') }}%
                                    </td>
                                    <td class="text-center">
                                        @include('finance.center-comparison.partials._etat_badge', [
                                            'etat' => $row['etat'],
                                        ])
                                    </td>
                                </tr>
                            @endforeach
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">
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
