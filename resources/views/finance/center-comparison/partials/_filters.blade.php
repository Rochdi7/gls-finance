{{-- 
    Filter form partial
    Expects: $type, $availableYears, $centers, $centerId, $year (optional), $yearFrom (optional), $yearTo (optional), $minRate (optional), $mode (optional)
--}}

@php
    $type = $type ?? 'monthly_year';

    $selectedYear = isset($year) && $year !== '' ? (int) $year : null;
    $selectedYearFrom = isset($yearFrom) && $yearFrom !== '' ? (int) $yearFrom : null;
    $selectedYearTo = isset($yearTo) && $yearTo !== '' ? (int) $yearTo : null;

    // minRate est stocké côté controller en décimal (ex: 0.85), on affiche en %
    $minRatePercent = isset($minRate) ? (int) round(((float) $minRate) * 100) : null;
@endphp

<div class="row mb-4">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Filtres</h5>
            </div>
            <div class="card-body">
                <form id="centerComparisonFilters" method="GET" action="{{ route('finance.center-comparison.index') }}" class="row g-3">
                    <!-- Type selector (always shown) -->
                    <div class="col-md-2">
                        <label for="type" class="form-label">
                            Type de Comparaison <span class="text-danger">*</span>
                        </label>
                        <select name="type" id="type" class="form-select solid">
                            <option value="monthly_year" @selected($type === 'monthly_year')>Comparaison entre les mois</option>
                            <option value="yoy_auto" @selected($type === 'yoy_auto')>Année vs année précédente</option>
                            <option value="years_between" @selected($type === 'years_between')>Comparaison 2 années</option>
                            <option value="trend_multi_year" @selected($type === 'trend_multi_year')>Tendance multi-années (par centre)</option>
                            <option value="ranking_year" @selected($type === 'ranking_year')>Classement primes (année)</option>
                        </select>
                    </div>

                    <!-- Conditional year/years filters -->
                    @if (in_array($type, ['monthly_year', 'yoy_auto', 'ranking_year'], true))
                        <!-- Single year -->
                        <div class="col-md-2">
                            <label for="year" class="form-label">
                                Année
                                @if ($type === 'monthly_year')
                                    <span class="text-danger">*</span>
                                @endif
                            </label>

                            <select name="year" id="year" class="form-select solid @error('year') is-invalid @enderror">
                                @if ($type === 'monthly_year')
                                    <option value="">— Choisir une année —</option>
                                @endif

                                @forelse($availableYears as $availableYear)
                                    <option value="{{ $availableYear }}" @selected($selectedYear !== null && $selectedYear === (int) $availableYear)>
                                        {{ $availableYear }}
                                    </option>
                                @empty
                                    <option value="">Aucune année disponible</option>
                                @endforelse
                            </select>

                            @if ($type === 'monthly_year' && $errors->has('year'))
                                <div class="invalid-feedback d-block">
                                    Veuillez choisir une année.
                                </div>
                            @endif
                        </div>

                    @elseif ($type === 'years_between')
                        <!-- Two years -->
                        <div class="col-md-2">
                            <label for="year_from" class="form-label">
                                Année (Actuelle) <span class="text-danger">*</span>
                            </label>
                            <select name="year_from" id="year_from" class="form-select solid">
                                @forelse($availableYears as $availableYear)
                                    <option value="{{ $availableYear }}" @selected($selectedYearFrom !== null && $selectedYearFrom === (int) $availableYear)>
                                        {{ $availableYear }}
                                    </option>
                                @empty
                                    <option value="">Aucune année disponible</option>
                                @endforelse
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label for="year_to" class="form-label">
                                Année (Référence) <span class="text-danger">*</span>
                            </label>
                            <select name="year_to" id="year_to" class="form-select solid">
                                @forelse($availableYears as $availableYear)
                                    <option value="{{ $availableYear }}" @selected($selectedYearTo !== null && $selectedYearTo === (int) $availableYear)>
                                        {{ $availableYear }}
                                    </option>
                                @empty
                                    <option value="">Aucune année disponible</option>
                                @endforelse
                            </select>
                        </div>
                    @endif

                    <!-- Center selector -->
                    <div class="col-md-2">
                        <label for="center_id" class="form-label">
                            Centre
                            @if ($type === 'trend_multi_year')
                                <span class="text-danger">*</span>
                            @endif
                        </label>

                        <select name="center_id" id="center_id" class="form-select solid">
                            <option value="">
                                @if ($type === 'trend_multi_year')
                                    -- Choisir un centre --
                                @else
                                    -- Tous les centres --
                                @endif
                            </option>

                            @foreach ($centers as $center)
                                <option value="{{ $center->id }}" @selected(isset($centerId) && (int) $centerId === (int) $center->id)>
                                    {{ $center->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Optional min_rate filter for ranking_year -->
                    @if ($type === 'ranking_year')
                        <div class="col-md-2">
                            <label for="min_rate" class="form-label">Taux Min (%)</label>
                            <input
                                type="number"
                                name="min_rate"
                                id="min_rate"
                                class="form-control"
                                placeholder="ex: 85"
                                value="{{ $minRatePercent !== null ? $minRatePercent : '' }}"
                                min="0"
                                max="100"
                                step="5"
                            >
                        </div>
                    @endif

                    <!-- Submit button -->
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-search me-2"></i>Filtrer
                        </button>
                    </div>
                </form>

                {{-- ✅ JS: empêche les paramètres "fantômes" (year_from/year_to/min_rate) de rester actifs --}}
                <script>
                    (function () {
                        const form = document.getElementById('centerComparisonFilters');
                        if (!form) return;

                        const typeSelect = document.getElementById('type');

                        function cleanupByType(selectedType) {
                            const year = document.getElementById('year');
                            const yearFrom = document.getElementById('year_from');
                            const yearTo = document.getElementById('year_to');
                            const minRate = document.getElementById('min_rate');

                            // Helper: disable + clear element if exists
                            const disableAndClear = (el) => {
                                if (!el) return;
                                el.value = '';
                                el.disabled = true;
                            };

                            const enable = (el) => {
                                if (!el) return;
                                el.disabled = false;
                            };

                            // Reset all first
                            if (year) year.disabled = false;
                            if (yearFrom) yearFrom.disabled = false;
                            if (yearTo) yearTo.disabled = false;
                            if (minRate) minRate.disabled = false;

                            // Now disable unused fields
                            if (selectedType === 'monthly_year' || selectedType === 'yoy_auto' || selectedType === 'ranking_year') {
                                // uses year
                                disableAndClear(yearFrom);
                                disableAndClear(yearTo);

                                if (selectedType !== 'ranking_year') {
                                    disableAndClear(minRate);
                                } else {
                                    enable(minRate);
                                }

                                enable(year);
                            }

                            if (selectedType === 'years_between') {
                                // uses year_from + year_to
                                disableAndClear(year);
                                disableAndClear(minRate);

                                enable(yearFrom);
                                enable(yearTo);
                            }

                            if (selectedType === 'trend_multi_year') {
                                // no year needed
                                disableAndClear(year);
                                disableAndClear(yearFrom);
                                disableAndClear(yearTo);
                                disableAndClear(minRate);
                            }
                        }

                        // When changing type => cleanup & submit to reload correct form fields
                        if (typeSelect) {
                            typeSelect.addEventListener('change', function () {
                                cleanupByType(this.value);

                                // submit immediately so the server renders the correct conditional fields
                                form.submit();
                            });
                        }

                        // Before submit (click Filtrer) => cleanup again to avoid ghost params
                        form.addEventListener('submit', function () {
                            const selectedType = typeSelect ? typeSelect.value : 'monthly_year';
                            cleanupByType(selectedType);
                        });
                    })();
                </script>
            </div>
        </div>
    </div>
</div>
