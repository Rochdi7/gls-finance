<?php

namespace App\Http\Requests\Finance\CenterMonthlyCollection;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CenterMonthlyCollectionStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // si tu as un middleware admin, c’est ok
    }

    public function rules(): array
    {
        return [
            'center_id' => ['required', 'integer', 'exists:centers,id'],

            'year'  => ['required', 'integer', 'min:2000', 'max:2100'],
            'month' => ['required', 'integer', 'min:1', 'max:12'],

            'cash_amount'          => ['nullable', 'numeric', 'min:0'],
            'tpe_amount'           => ['nullable', 'numeric', 'min:0'],
            'bank_transfer_amount' => ['nullable', 'numeric', 'min:0'],
            'cheque_amount'        => ['nullable', 'numeric', 'min:0'],

            'note' => ['nullable', 'string', 'max:2000'],

            // ✅ Un seul enregistrement centre+année+mois
            Rule::unique('center_monthly_collections')
                ->where(fn ($q) => $q
                    ->where('center_id', $this->input('center_id'))
                    ->where('year', $this->input('year'))
                    ->where('month', $this->input('month'))
                ),
        ];
    }

    protected function prepareForValidation(): void
    {
        // ✅ Si champs vides => 0 (pratique pour ton formulaire)
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

            'year.required'  => 'Veuillez choisir une année.',
            'month.required' => 'Veuillez choisir un mois.',

            'cash_amount.min'          => 'Le montant espèces doit être supérieur ou égal à 0.',
            'tpe_amount.min'           => 'Le montant TPE doit être supérieur ou égal à 0.',
            'bank_transfer_amount.min' => 'Le montant virement bancaire doit être supérieur ou égal à 0.',
            'cheque_amount.min'        => 'Le montant chèque doit être supérieur ou égal à 0.',

            'unique' => 'Un enregistrement existe déjà pour ce centre, ce mois et cette année.',
        ];
    }
}
