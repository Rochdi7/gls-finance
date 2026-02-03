@csrf

@php
    // ✅ Unifie: on accepte soit $monthly_financial (recommandé), soit $monthly (ancien)
    $monthly = $monthly_financial ?? $monthly ?? null;
    $isEdit = (bool) $monthly;
@endphp

<div class="row">

    {{-- Centre --}}
    <div class="col-xl-6 col-md-6 mb-4">
        <label class="form-label required">Centre</label>
        <select name="center_id"
                class="form-control default-select @error('center_id') is-invalid @enderror"
                {{ $isEdit ? 'disabled' : '' }}>
            <option value="">— Choisir —</option>
            @foreach ($centers as $center)
                <option value="{{ $center->id }}"
                    @selected((int) old('center_id', $monthly->center_id ?? 0) === (int) $center->id)>
                    {{ $center->name }} – {{ $center->city }}
                </option>
            @endforeach
        </select>

        {{-- si edit: on désactive le select => on garde la valeur via hidden --}}
        @if ($isEdit)
            <input type="hidden" name="center_id" value="{{ $monthly->center_id }}">
        @endif

        @error('center_id')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    {{-- Mois --}}
    <div class="col-xl-3 col-md-6 mb-4">
        <label class="form-label required">Mois</label>
        <select name="month"
                class="form-control default-select @error('month') is-invalid @enderror"
                {{ $isEdit ? 'disabled' : '' }}>
            @for ($m = 1; $m <= 12; $m++)
                <option value="{{ $m }}"
                    @selected((int) old('month', $monthly->month ?? now()->month) === (int) $m)>
                    {{ str_pad($m, 2, '0', STR_PAD_LEFT) }}
                </option>
            @endfor
        </select>

        @if ($isEdit)
            <input type="hidden" name="month" value="{{ $monthly->month }}">
        @endif

        @error('month')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    {{-- Année --}}
    <div class="col-xl-3 col-md-6 mb-4">
        <label class="form-label required">Année</label>
        <input type="number"
               name="year"
               class="form-control @error('year') is-invalid @enderror"
               value="{{ old('year', $monthly->year ?? now()->year) }}"
               {{ $isEdit ? 'readonly' : '' }}>
        @error('year')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    {{-- Étudiants --}}
    <div class="col-xl-4 col-md-6 mb-4">
        <label class="form-label required">Nombre total d’étudiants</label>
        <input type="number"
               min="0"
               name="total_students"
               class="form-control @error('total_students') is-invalid @enderror"
               value="{{ old('total_students', $monthly->total_students ?? 0) }}">
        @error('total_students')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    {{-- Revenu --}}
    <div class="col-xl-4 col-md-6 mb-4">
        <label class="form-label required">Revenu total (DH)</label>
        <input type="number"
               min="0"
               name="total_revenue"
               class="form-control @error('total_revenue') is-invalid @enderror"
               value="{{ old('total_revenue', $monthly->total_revenue ?? 0) }}">
        @error('total_revenue')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    {{-- Statut (verrou) --}}
    <div class="col-xl-4 col-md-6 mb-4">
        <label class="form-label">Statut</label>
        <select name="locked"
                class="form-control default-select @error('locked') is-invalid @enderror">
            <option value="0" @selected((int) old('locked', $monthly->locked ?? 0) === 0)>Ouvert</option>
            <option value="1" @selected((int) old('locked', $monthly->locked ?? 0) === 1)>Verrouillé</option>
        </select>
        @error('locked')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    {{-- Historique --}}
    <div class="col-xl-12">
        <div class="form-check mt-2">
            {{-- important: checkbox => si décoché, rien n’est envoyé. --}}
            <input class="form-check-input"
                   type="checkbox"
                   id="is_historical"
                   name="is_historical"
                   value="1"
                   @checked((bool) old('is_historical', $monthly->is_historical ?? false))>
            <label class="form-check-label" for="is_historical">
                Donnée historique (import manuel)
            </label>
        </div>
    </div>

</div>
