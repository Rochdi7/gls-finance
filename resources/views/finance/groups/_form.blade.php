@php
    $isEdit = isset($group);

    $monthNames = [
        1 => 'Janvier',
        2 => 'Février',
        3 => 'Mars',
        4 => 'Avril',
        5 => 'Mai',
        6 => 'Juin',
        7 => 'Juillet',
        8 => 'Août',
        9 => 'Septembre',
        10 => 'Octobre',
        11 => 'Novembre',
        12 => 'Décembre',
    ];

    /**
     * ✅ En EDIT: on reconstruit la table depuis la DB
     * ✅ En CREATE: on reconstruit via old('stats') si validation fail
     */
    $existingStats = $isEdit
        ? ($group->monthlyStats ?? collect())
        : collect();

    $oldStats = !$isEdit ? old('stats', []) : [];

    // ✅ rows affichées dans le tableau
    $rows = $isEdit
        ? $existingStats->sortBy('month')->values()
        : collect($oldStats);
@endphp
@php
    $levels = $levels ?? \App\Models\Group::LEVELS;
@endphp
{{-- ==============
   INFOS GROUPE
============== --}}
<div class="row">

    {{-- Centre --}}
    <div class="col-md-6 mb-4">
        <label class="form-label">Centre *</label>
        <select name="center_id" class="form-control" required @if ($isEdit) disabled @endif>
            <option value="">— Choisir —</option>
            @foreach ($centers as $center)
                <option value="{{ $center->id }}" @selected(old('center_id', $group->center_id ?? null) == $center->id)>
                    {{ $center->name }}
                </option>
            @endforeach
        </select>
        @if ($isEdit)
            <input type="hidden" name="center_id" value="{{ $group->center_id }}">
        @endif
        @error('center_id')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    {{-- Professeur --}}
    <div class="col-md-6 mb-4">
        <label class="form-label">Professeur</label>
        <select name="professor_id" class="form-control" @if ($isEdit) disabled @endif>
            <option value="">— Non assigné —</option>
            @foreach ($professors as $prof)
                <option value="{{ $prof->id }}" @selected(old('professor_id', $group->professor_id ?? null) == $prof->id)>
                    {{ $prof->name }}
                </option>
            @endforeach
        </select>
        @if ($isEdit)
            <input type="hidden" name="professor_id" value="{{ $group->professor_id }}">
        @endif
        @error('professor_id')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    {{-- Niveau --}}
    <div class="col-md-3 mb-4">
        <label class="form-label">Niveau *</label>
        <select name="level_code" class="form-control" required @if ($isEdit) disabled @endif>
            <option value="">— Choisir —</option>
            @foreach ($levels as $level)
                <option value="{{ $level }}" @selected(old('level_code', $group->level_code ?? '') === $level)>
                    {{ $level }}
                </option>
            @endforeach
        </select>
        @if ($isEdit)
            <input type="hidden" name="level_code" value="{{ $group->level_code }}">
        @endif
        @error('level_code')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    {{-- Année --}}
    <div class="col-md-3 mb-4">
        <label class="form-label">Année *</label>
        <select name="year" id="yearInput" class="form-control" required @if ($isEdit) disabled @endif>
            @php
                $minYear = now()->year - 2;
                $maxYear = now()->year + 10;
                $yearOld = old('year', $group->year ?? now()->year);
            @endphp
            @for ($y = $maxYear; $y >= $minYear; $y--)
                <option value="{{ $y }}" @selected($yearOld == $y)>{{ $y }}</option>
            @endfor
        </select>
        @if ($isEdit)
            <input type="hidden" name="year" value="{{ $group->year }}">
        @endif
        @error('year')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    {{-- Statut --}}
    <div class="col-md-3 mb-4">
        <label class="form-label">Statut du groupe *</label>
        <select name="group_status" class="form-control" required>
            <option value="active" @selected(old('group_status', $group->status ?? 'active') === 'active')>Actif</option>
            <option value="finished" @selected(old('group_status', $group->status ?? 'active') === 'finished')>Terminé</option>
        </select>
        @error('group_status')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
        <small class="text-muted d-block mt-1">
            Ce statut est global au groupe, pas par mois.
        </small>
    </div>

</div>

{{-- En EDIT: Nom readonly --}}
@if ($isEdit)
    <div class="row">
        <div class="col-12 mb-4">
            <label class="form-label">Nom du groupe</label>
            <input type="text" class="form-control" value="{{ $group->name }}" readonly>
            <small class="text-muted d-block mt-1">Le nom est généré automatiquement.</small>
        </div>
    </div>
@endif

{{-- ==============
   DONNÉES MENSUELLES
============== --}}
<hr class="my-4">
<h6 class="mb-3">Données mensuelles (snapshots)</h6>

{{-- Month Picker + bouton (EN CREATE & EDIT) --}}
<div class="row align-items-end g-2">
    <div class="col-md-4 mb-3">
        <label class="form-label">Mois</label>
        <select id="monthPicker" class="form-control">
            @foreach ($monthNames as $num => $label)
                <option value="{{ $num }}">{{ $label }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-2 mb-3">
        <button type="button" id="addMonthBtn" class="btn btn-primary w-100">
            Ajouter
        </button>
    </div>

    <div class="col-md-6 mb-3">
        <div class="small text-muted">
            Ajoute un mois puis complète "début / fin / prix". Tu peux supprimer une ligne avant d'enregistrer.
        </div>
    </div>
</div>

{{-- TABLE --}}
<div class="row">
    <div class="col-12">
        <div class="table-responsive">
            <table class="table table-bordered align-middle" id="statsTable">
                <thead>
                    <tr>
                        <th style="width: 18%;">Mois</th>
                        <th style="width: 18%;">Étudiants début</th>
                        <th style="width: 18%;">Étudiants fin</th>
                        <th style="width: 18%;">Prix / étudiant (DH)</th>
                        <th style="width: 10%;">Action</th>
                    </tr>
                </thead>
                <tbody id="statsTbody">

                    {{-- ✅ En EDIT: records DB --}}
                    @if ($isEdit)
                        @foreach ($rows as $i => $stat)
                            @php
                                $m = (int) ($stat->month ?? 1);
                                $label = $monthNames[$m] ?? ('Mois ' . $m);
                                $start = old("stats.$i.students_start_count", $stat->students_start_count);
                                $end   = old("stats.$i.students_end_count", $stat->students_end_count);
                                $price = old("stats.$i.price_per_student", $group->price_per_student); // fallback
                            @endphp
                            <tr data-month="{{ $m }}">
                                <td>
                                    <strong>{{ $label }}</strong>
                                    <input type="hidden" name="stats[{{ $i }}][month]" value="{{ $m }}">
                                    <input type="hidden" name="stats[{{ $i }}][id]" value="{{ $stat->id }}">
                                </td>
                                <td>
                                    <input type="number" min="0" class="form-control"
                                           name="stats[{{ $i }}][students_start_count]"
                                           value="{{ $start }}" required>
                                </td>
                                <td>
                                    <input type="number" min="0" class="form-control"
                                           name="stats[{{ $i }}][students_end_count]"
                                           value="{{ $end }}" required>
                                </td>
                                <td>
                                    <input type="number" min="0" class="form-control"
                                           name="stats[{{ $i }}][price_per_student]"
                                           value="{{ $price }}" required>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-danger light js-remove-row">
                                        Supprimer
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        {{-- ✅ En CREATE: old stats --}}
                        @foreach ($rows as $rowIndex => $row)
                            @php
                                $m = (int) ($row['month'] ?? 1);
                                $label = $monthNames[$m] ?? 'Mois ' . $m;
                            @endphp
                            <tr data-month="{{ $m }}">
                                <td>
                                    <strong>{{ $label }}</strong>
                                    <input type="hidden" name="stats[{{ $rowIndex }}][month]" value="{{ $m }}">
                                </td>
                                <td>
                                    <input type="number" min="0" class="form-control"
                                           name="stats[{{ $rowIndex }}][students_start_count]"
                                           value="{{ $row['students_start_count'] ?? '' }}" required>
                                </td>
                                <td>
                                    <input type="number" min="0" class="form-control"
                                           name="stats[{{ $rowIndex }}][students_end_count]"
                                           value="{{ $row['students_end_count'] ?? '' }}" required>
                                </td>
                                <td>
                                    <input type="number" min="0" class="form-control"
                                           name="stats[{{ $rowIndex }}][price_per_student]"
                                           value="{{ $row['price_per_student'] ?? '' }}" required>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-danger light js-remove-row">
                                        Supprimer
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>
        </div>

        @error('stats')
            <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror
        @foreach ($errors->get('stats.*') as $error)
            <div class="alert alert-danger mt-2">{{ implode(', ', $error) }}</div>
        @endforeach
    </div>
</div>

{{-- ✅ JS --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    const monthNames = @json($monthNames);
    const monthPicker = document.getElementById('monthPicker');
    const addBtn = document.getElementById('addMonthBtn');
    const tbody = document.getElementById('statsTbody');

    function currentIndex() {
        return tbody.querySelectorAll('tr').length;
    }

    function monthAlreadyAdded(month) {
        return !!tbody.querySelector('tr[data-month="' + month + '"]');
    }

    function addRow(month) {
        if (monthAlreadyAdded(month)) {
            alert('Ce mois est déjà ajouté.');
            return;
        }

        const idx = currentIndex();
        const label = monthNames[month] || ('Mois ' + month);

        const tr = document.createElement('tr');
        tr.setAttribute('data-month', month);

        tr.innerHTML = `
            <td>
                <strong>${label}</strong>
                <input type="hidden" name="stats[${idx}][month]" value="${month}">
            </td>
            <td>
                <input type="number" min="0" class="form-control" name="stats[${idx}][students_start_count]" required>
            </td>
            <td>
                <input type="number" min="0" class="form-control" name="stats[${idx}][students_end_count]" required>
            </td>
            <td>
                <input type="number" min="0" class="form-control" name="stats[${idx}][price_per_student]" required>
            </td>
            <td class="text-center">
                <button type="button" class="btn btn-sm btn-danger light js-remove-row">Supprimer</button>
            </td>
        `;

        tbody.appendChild(tr);
    }

    addBtn.addEventListener('click', function () {
        const month = parseInt(monthPicker.value, 10);
        addRow(month);
    });

    tbody.addEventListener('click', function (e) {
        if (e.target.classList.contains('js-remove-row')) {
            e.target.closest('tr').remove();

            // re-index stats[i][...]
            const rows = tbody.querySelectorAll('tr');
            rows.forEach((row, i) => {
                row.querySelectorAll('input').forEach(input => {
                    if (input.name.startsWith('stats[')) {
                        input.name = input.name.replace(/stats\[\d+\]/, 'stats[' + i + ']');
                    }
                });
            });
        }
    });

});
</script>
