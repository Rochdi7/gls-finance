<?php

namespace App\Http\Requests\Finance\Group;

use App\Models\Group;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GroupUpdateRequest extends FormRequest
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
            'professor_id' => ['nullable', 'integer', 'exists:professors,id'],

            'level_code' => ['required', 'string', Rule::in(Group::LEVELS)],

            'students_start_count' => ['required', 'integer', 'min:0', 'max:1000'],
            'students_end_count'   => ['required', 'integer', 'min:0', 'max:1000'],

            'price_per_student' => ['required', 'integer', 'min:0', 'max:100000'],

            'month' => ['required', 'integer', 'min:1', 'max:12'],
            'year'  => ['required', 'integer', 'min:'.$yearMin, 'max:'.$yearMax],

            'status' => ['nullable', 'string', Rule::in(Group::STATUSES)],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($v) {
            $start = (int) $this->input('students_start_count', 0);
            $end   = (int) $this->input('students_end_count', 0);

            if ($end > $start) {
                $v->errors()->add('students_end_count', 'Le nombre d’étudiants (fin) ne peut pas dépasser le nombre (début).');
            }
        });
    }

    protected function prepareForValidation(): void
    {
        if ($this->filled('level_code')) {
            $this->merge(['level_code' => strtoupper(trim((string) $this->input('level_code')))]);
        }

        if (!$this->filled('status')) {
            $this->merge(['status' => 'active']);
        }
    }
}
