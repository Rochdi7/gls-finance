@php
    $isEdit = isset($collection);

    $selectedCenterId = old('center_id', $collection->center_id ?? ($defaultCenterId ?? ''));
@endphp

<div class="row">

    {{-- Centre --}}
    <div class="col-md-6 mb-3">
        <label class="form-label">Centre</label>
        <select name="center_id" class="form-control" required>
            <option value="">-- Choisir un centre --</option>
            @foreach ($centers as $center)
                <option value="{{ $center->id }}" @selected((string) $selectedCenterId === (string) $center->id)>
                    {{ $center->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Année --}}
    <div class="col-md-3 mb-3">
        <label class="form-label">Année</label>
        <input type="number" name="year" class="form-control"
            value="{{ old('year', $collection->year ?? now()->year) }}" required>
    </div>

    {{-- Mois --}}
    <div class="col-md-3 mb-3">
        <label class="form-label">Mois</label>
        <select name="month" class="form-control" required>
            @for ($m = 1; $m <= 12; $m++)
                <option value="{{ $m }}" @selected(old('month', $collection->month ?? '') == $m)>
                    {{ $m }}
                </option>
            @endfor
        </select>
    </div>

    {{-- Montants --}}
    @foreach ([
        'cash_amount' => 'Espèces',
        'tpe_amount' => 'TPE',
        'bank_transfer_amount' => 'Virement bancaire',
        'cheque_amount' => 'Chèque',
    ] as $field => $label)
        <div class="col-md-3 mb-3">
            <label class="form-label">{{ $label }}</label>
            <input type="number" step="0.01" name="{{ $field }}" class="form-control amount-field"
                value="{{ old($field, $collection->$field ?? 0) }}">
        </div>
    @endforeach

    {{-- Total --}}
    <div class="col-md-3 mb-3">
        <label class="form-label">Total</label>
        <input type="text" class="form-control fw-bold" id="total_amount" readonly>
    </div>

    {{-- Note --}}
    <div class="col-12 mb-3">
        <label class="form-label">Remarques</label>
        <textarea name="note" class="form-control" rows="3">{{ old('note', $collection->note ?? '') }}</textarea>
    </div>

</div>

@push('scripts')
    <script>
        function calculateTotal() {
            let total = 0;
            document.querySelectorAll('.amount-field').forEach(el => {
                total += parseFloat(el.value || 0);
            });
            document.getElementById('total_amount').value = total.toFixed(2);
        }

        document.querySelectorAll('.amount-field').forEach(el => {
            el.addEventListener('input', calculateTotal);
        });

        calculateTotal();
    </script>
@endpush
