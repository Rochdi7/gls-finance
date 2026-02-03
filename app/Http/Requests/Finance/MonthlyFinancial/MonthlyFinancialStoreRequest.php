<?php

namespace App\Http\Requests\Finance\MonthlyFinancial;

use Illuminate\Foundation\Http\FormRequest;

class MonthlyFinancialStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $yearMin = 2023;
        $yearMax = (int) now()->year + 5;

        return [
            'center_id' => ['required', 'integer', 'exists:centers,id'],
            'month'     => ['required', 'integer', 'min:1', 'max:12'],
            'year'      => ['required', 'integer', 'min:'.$yearMin, 'max:'.$yearMax],

            // ✅ Historique: tu saisis total_students + total_revenue
            'total_students' => ['required', 'integer', 'min:0', 'max:100000'],
            'total_revenue'  => ['required', 'integer', 'min:0', 'max:100000000'],

            // Optionnel (peut être auto-calculé côté service/controller)
            'owner_share_50'      => ['nullable', 'integer', 'min:0', 'max:100000000'],
            'professors_share_35' => ['nullable', 'integer', 'min:0', 'max:100000000'],
            'other_costs_15'      => ['nullable', 'integer', 'min:0', 'max:100000000'],

            'is_historical' => ['nullable', 'boolean'],
            'locked'        => ['nullable', 'boolean'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_historical' => $this->has('is_historical') ? (bool) $this->boolean('is_historical') : false,
            'locked'        => $this->has('locked') ? (bool) $this->boolean('locked') : false,
        ]);
    }
}
