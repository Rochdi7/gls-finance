<?php

namespace App\Http\Requests\Finance\GroupMonthlyStat;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GroupMonthlyStatUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $yearMin = 2023;
        $yearMax = (int) now()->year + 5;

        // Route model binding: /group-monthly-stats/{group_monthly_stat}
        // On récupère l'id du record courant pour ignorer l'unicité
        $currentId = optional($this->route('group_monthly_stat'))->id
            ?? optional($this->route('groupMonthlyStat'))->id
            ?? (int) $this->route('id');

        return [
            'group_id' => ['required', 'integer', 'exists:groups,id'],

            'month' => ['required', 'integer', 'min:1', 'max:12'],
            'year'  => ['required', 'integer', 'min:'.$yearMin, 'max:'.$yearMax],

            'students_start_count' => ['required', 'integer', 'min:0', 'max:1000'],
            'students_end_count'   => ['required', 'integer', 'min:0', 'max:1000'],

            'revenue' => ['required', 'integer', 'min:0', 'max:100000000'],

            // ✅ Unicité group_id/month/year en ignorant le record courant
            Rule::unique('group_monthly_stats')
                ->ignore($currentId)
                ->where(fn ($q) => $q
                    ->where('group_id', $this->input('group_id'))
                    ->where('month', $this->input('month'))
                    ->where('year', $this->input('year'))
                ),
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($v) {
            $start = (int) $this->input('students_start_count', 0);
            $end   = (int) $this->input('students_end_count', 0);

            if ($end > $start) {
                $v->errors()->add(
                    'students_end_count',
                    'Le nombre d’étudiants (fin) ne peut pas dépasser le nombre (début).'
                );
            }
        });
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'group_id' => $this->filled('group_id') ? (int) $this->input('group_id') : null,
            'month'    => $this->filled('month') ? (int) $this->input('month') : null,
            'year'     => $this->filled('year') ? (int) $this->input('year') : null,
            'students_start_count' => $this->filled('students_start_count') ? (int) $this->input('students_start_count') : 0,
            'students_end_count'   => $this->filled('students_end_count') ? (int) $this->input('students_end_count') : 0,
            'revenue'  => $this->filled('revenue') ? (int) $this->input('revenue') : 0,
        ]);
    }
}
