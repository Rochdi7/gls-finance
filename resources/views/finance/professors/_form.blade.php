@php
    /** @var \App\Models\Professor|null $professor */
    $isEdit = isset($professor) && $professor;
@endphp

<div class="row">
    <div class="col-xl-6 col-md-6 mb-4">
        <label class="form-label">Nom du professeur<span class="text-danger scale5 ms-2">*</span></label>
        <input
            type="text"
            name="name"
            class="form-control @error('name') is-invalid @enderror"
            placeholder="Nom"
            value="{{ old('name', $professor->name ?? '') }}"
            required
        >
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-xl-6 col-md-6 mb-4">
        <label class="form-label">Téléphone</label>
        <input
            type="text"
            name="phone"
            class="form-control @error('phone') is-invalid @enderror"
            placeholder="Téléphone"
            value="{{ old('phone', $professor->phone ?? '') }}"
        >
        @error('phone')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-xl-12">
        <label class="form-label me-3">Statut :</label>

        <div class="form-check form-check-inline">
            <input
                class="form-check-input"
                type="radio"
                name="active"
                id="prof_active_1"
                value="1"
                {{ old('active', (int) ($professor->active ?? 1)) === 1 ? 'checked' : '' }}
            >
            <label class="form-check-label" for="prof_active_1">Actif</label>
        </div>

        <div class="form-check form-check-inline">
            <input
                class="form-check-input"
                type="radio"
                name="active"
                id="prof_active_0"
                value="0"
                {{ old('active', (int) ($professor->active ?? 1)) === 0 ? 'checked' : '' }}
            >
            <label class="form-check-label" for="prof_active_0">Inactif</label>
        </div>

        @error('active')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
</div>
