@php
    /** @var \App\Models\Center|null $center */
    $isEdit = isset($center) && $center?->exists;

    // Default values
    $name   = old('name', $center->name ?? '');
    $city   = old('city', $center->city ?? '');

    // active can come as "1"/"0" or boolean
    $activeOld = old('active', isset($center) ? (int) $center->active : 1);
    $active = (string) $activeOld; // "1" or "0"
@endphp

<div class="row">
    {{-- Name --}}
    <div class="col-xl-6 col-md-6 mb-4">
        <label class="form-label">Center Name<span class="text-danger scale5 ms-2">*</span></label>
        <input
            type="text"
            name="name"
            class="form-control @error('name') is-invalid @enderror"
            placeholder="Name"
            aria-label="name"
            value="{{ $name }}"
            required
        >
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- City --}}
    <div class="col-xl-6 col-md-6 mb-4">
        <label class="form-label">City<span class="text-danger scale5 ms-2">*</span></label>
        <input
            type="text"
            name="city"
            class="form-control @error('city') is-invalid @enderror"
            placeholder="City"
            aria-label="city"
            value="{{ $city }}"
            required
        >
        @error('city')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Active (radio) --}}
    <div class="col-xl-12">
        <label class="form-label me-3">Status:</label>

        <div class="form-check form-check-inline">
            <input
                class="form-check-input @error('active') is-invalid @enderror"
                type="radio"
                name="active"
                id="inlineRadio1"
                value="1"
                {{ $active === '1' ? 'checked' : '' }}
            >
            <label class="form-check-label" for="inlineRadio1">Active</label>
        </div>

        <div class="form-check form-check-inline">
            <input
                class="form-check-input @error('active') is-invalid @enderror"
                type="radio"
                name="active"
                id="inlineRadio2"
                value="0"
                {{ $active === '0' ? 'checked' : '' }}
            >
            <label class="form-check-label" for="inlineRadio2">In Active</label>
        </div>

        @error('active')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>
</div>
