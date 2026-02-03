<?php

namespace App\Http\Requests\Finance\MonthlyFinancial;

use App\Models\MonthlyFinancial;
use Illuminate\Foundation\Http\FormRequest;

class MonthlyFinancialUpdateRequest extends FormRequest
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

            'total_students' => ['required', 'integer', 'min:0', 'max:100000'],
            'total_revenue'  => ['required', 'integer', 'min:0', 'max:100000000'],

            'owner_share_50'      => ['nullable', 'integer', 'min:0', 'max:100000000'],
            'professors_share_35' => ['nullable', 'integer', 'min:0', 'max:100000000'],
            'other_costs_15'      => ['nullable', 'integer', 'min:0', 'max:100000000'],

            'is_historical' => ['nullable', 'boolean'],
            'locked'        => ['nullable', 'boolean'],
        ];
    }

    public function withValidator($validator): void
    {
        /** @var MonthlyFinancial|null $mf */
        $mf = $this->route('monthly_financial');

        // Si route model binding pas utilisé, tente via id
        if (!$mf && $this->route('id')) {
            $mf = MonthlyFinancial::find($this->route('id'));
        }

        $validator->after(function ($v) use ($mf) {
            // ✅ Interdit modification si locked=true
            if ($mf && (bool) $mf->locked === true) {
                $v->errors()->add('locked', 'Ce mois est verrouillé. Modification interdite.');
            }
        });
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_historical' => $this->has('is_historical') ? (bool) $this->boolean('is_historical') : false,
            'locked'        => $this->has('locked') ? (bool) $this->boolean('locked') : false,
        ]);
    }
}
