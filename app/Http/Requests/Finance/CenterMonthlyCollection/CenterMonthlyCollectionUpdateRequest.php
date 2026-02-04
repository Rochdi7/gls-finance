<?php

namespace App\Http\Requests\Finance\CenterMonthlyCollection;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CenterMonthlyCollectionUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        /** @var \App\Models\CenterMonthlyCollection $row */
        $row = $this->route('centerMonthlyCollection');

        return [
            'center_id' => ['required', 'integer', 'exists:centers,id'],

            'year'  => ['required', 'integer', 'min:2000', 'max:2100'],
            'month' => ['required', 'integer', 'min:1', 'max:12'],

            'cash_amount'          => ['nullable', 'numeric', 'min:0'],
            'tpe_amount'           => ['nullable', 'numeric', 'min:0'],
            'bank_transfer_amount' => ['nullable', 'numeric', 'min:0'],
            'cheque_amount'        => ['nullable', 'numeric', 'min:0'],

            'note' => ['nullable', 'string', 'max:2000'],

            // ✅ Unique centre+année+mois (en ignorant la ligne actuelle)
            Rule::unique('center_monthly_collections')
                ->ignore($row?->id)
                ->where(fn ($q) => $q
                    ->where('center_id', $this->input('center_id'))
                    ->where('year', $this->input('year'))
                    ->where('month', $this->input('month'))
                ),
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'cash_amount'          => $this->input('cash_amount') === null ? 0 : $this->input('cash_amount'),
            'tpe_amount'           => $this->input('tpe_amount') === null ? 0 : $this->input('tpe_amount'),
            'bank_transfer_amount' => $this->input('bank_transfer_amount') === null ? 0 : $this->input('bank_transfer_amount'),
            'cheque_amount'        => $this->input('cheque_amount') === null ? 0 : $this->input('cheque_amount'),
        ]);
    }

    public function messages(): array
    {
        return [
            'center_id.required' => 'Veuillez sélectionner un centre.',
            'center_id.exists'   => 'Le centre sélectionné est invalide.',
            'year.required'      => 'Veuillez choisir une année.',
            'month.required'     => 'Veuillez choisir un mois.',
            'unique'             => 'Un enregistrement existe déjà pour ce centre, ce mois et cette année.',
        ];
    }
}
