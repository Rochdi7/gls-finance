@php
    $isEdit = isset($group);
@endphp

<div class="row">

    <div class="col-md-6 mb-4">
        <label class="form-label">Centre *</label>
        <select name="center_id" class="form-control" required>
            @foreach ($centers as $center)
                <option value="{{ $center->id }}"
                    @selected(old('center_id', $group->center_id ?? null) == $center->id)>
                    {{ $center->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6 mb-4">
        <label class="form-label">Professeur *</label>
        <select name="professor_id" class="form-control" required>
            @foreach ($professors as $prof)
                <option value="{{ $prof->id }}"
                    @selected(old('professor_id', $group->professor_id ?? null) == $prof->id)>
                    {{ $prof->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3 mb-4">
        <label class="form-label">Niveau *</label>
        <select name="level_code" class="form-control" required>
            @foreach (\App\Models\Group::LEVELS as $level)
                <option value="{{ $level }}"
                    @selected(old('level_code', $group->level_code ?? '') === $level)>
                    {{ $level }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3 mb-4">
        <label class="form-label">Mois *</label>
        <input type="number" name="month" class="form-control"
               value="{{ old('month', $group->month ?? now()->month) }}" min="1" max="12" required>
    </div>

    <div class="col-md-3 mb-4">
        <label class="form-label">Année *</label>
        <input type="number" name="year" class="form-control"
               value="{{ old('year', $group->year ?? now()->year) }}" required>
    </div>

    <div class="col-md-3 mb-4">
        <label class="form-label">Statut *</label>
        <select name="status" class="form-control">
            @foreach (\App\Models\Group::STATUSES as $status)
                <option value="{{ $status }}"
                    @selected(old('status', $group->status ?? 'active') === $status)>
                    {{ $status === 'active' ? 'Actif' : 'Terminé' }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4 mb-4">
        <label class="form-label">Étudiants début *</label>
        <input type="number" name="students_start_count" class="form-control"
               value="{{ old('students_start_count', $group->students_start_count ?? 0) }}" required>
    </div>

    <div class="col-md-4 mb-4">
        <label class="form-label">Étudiants fin *</label>
        <input type="number" name="students_end_count" class="form-control"
               value="{{ old('students_end_count', $group->students_end_count ?? 0) }}" required>
    </div>

    <div class="col-md-4 mb-4">
        <label class="form-label">Prix / étudiant (DH) *</label>
        <input type="number" name="price_per_student" class="form-control"
               value="{{ old('price_per_student', $group->price_per_student ?? 0) }}" required>
    </div>

</div>
