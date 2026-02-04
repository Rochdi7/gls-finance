{{-- 
    Ranking table for primes allocation
    Expects: $rows, $year
--}}

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Classement des Centres pour Primes - {{ $year }}</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-sm mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">Rang</th>
                            <th class="text-start">Centre</th>
                            <th class="text-start">Ville</th>
                            <th class="text-end">Encaissé (DH)</th>
                            <th class="text-center">Taux %</th>
                            <th class="text-center">Croissance %</th>
                            <th class="text-center">Score Primes</th>
                            <th class="text-center">État</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rows as $row)
                            <tr>
                                <td class="text-center">
                                    <strong>
                                        @if ($row['rank'] == 1)
                                            <i class="fas fa-medal text-warning"></i>
                                        @elseif ($row['rank'] == 2)
                                            <i class="fas fa-medal text-secondary"></i>
                                        @elseif ($row['rank'] == 3)
                                            <i class="fas fa-medal" style="color: #CD7F32;"></i>
                                        @endif
                                        {{ $row['rank'] }}
                                    </strong>
                                </td>
                                <td class="text-start">
                                    {{ $row['center_name'] }}
                                </td>
                                <td class="text-start">
                                    {{ $row['city'] }}
                                </td>
                                <td class="text-end">
                                    {{ number_format($row['collected_current'], 2, ',', ' ') }}
                                </td>
                                <td class="text-center">
                                    {{ number_format($row['collection_rate_current'] * 100, 1, ',', ' ') }}%
                                </td>
                                <td class="text-center">
                                    @if ($row['growth_collected'] >= 0)
                                        <span class="text-success">
                                            +{{ number_format($row['growth_collected'] * 100, 1, ',', ' ') }}%
                                        </span>
                                    @else
                                        <span class="text-danger">
                                            {{ number_format($row['growth_collected'] * 100, 1, ',', ' ') }}%
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <strong
                                        class="text-primary">{{ number_format($row['score'], 2, ',', ' ') }}</strong>
                                </td>
                                <td class="text-center">
                                    @include('finance.center-comparison.partials._etat_badge', [
                                        'etat' => $row['etat_year'],
                                    ])
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">
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
