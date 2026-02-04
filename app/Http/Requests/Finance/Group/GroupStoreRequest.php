<?php

namespace App\Http\Requests\Finance\Group;

use App\Models\Group;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GroupStoreRequest extends FormRequest
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
            'name' => ['nullable', 'string', 'max:150'],

            'level_code' => ['required', 'string', Rule::in(Group::LEVELS)],
            'year'  => ['required', 'integer', 'min:'.$yearMin, 'max:'.$yearMax],

            // ✅ ton select s'appelle group_status dans le Blade
            'group_status' => ['required', 'string', Rule::in(Group::STATUSES)],

            // ✅ monthly rows - stats must be sequential array
            'stats' => ['required', 'array', 'min:1'],
            'stats.*.month' => ['required', 'integer', 'min:1', 'max:12'],
            'stats.*.students_start_count' => ['required', 'integer', 'min:0', 'max:1000'],
            'stats.*.students_end_count'   => ['required', 'integer', 'min:0', 'max:1000'],
            'stats.*.price_per_student'    => ['required', 'integer', 'min:0', 'max:100000'],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($v) {
            $stats = (array) $this->input('stats', []);

            // ✅ end <= start pour chaque ligne
            foreach ($stats as $i => $row) {
                $start = (int) ($row['students_start_count'] ?? 0);
                $end   = (int) ($row['students_end_count'] ?? 0);

                if ($end > $start) {
                    $v->errors()->add("stats.$i.students_end_count", "La fin ne peut pas dépasser le début (ligne ".($i+1).").");
                }
            }

            // ✅ empêcher mois dupliqués
            $months = array_map(fn ($r) => (int)($r['month'] ?? 0), $stats);
            $months = array_filter($months);
            if (count($months) !== count(array_unique($months))) {
                $v->errors()->add('stats', 'Chaque mois ne peut apparaître qu’une seule fois.');
            }
        });
    }

    protected function prepareForValidation(): void
    {
        if ($this->filled('level_code')) {
            $this->merge(['level_code' => strtoupper(trim((string) $this->input('level_code')))]);
        }

        if ($this->filled('name')) {
            $this->merge(['name' => trim((string) $this->input('name'))]);
        }

        // ✅ Normaliser stats
        $stats = (array) $this->input('stats', []);
        $stats = array_values($stats);

        foreach ($stats as &$row) {
            $row['month'] = isset($row['month']) ? (int) $row['month'] : null;
            $row['students_start_count'] = isset($row['students_start_count']) ? (int) $row['students_start_count'] : 0;
            $row['students_end_count']   = isset($row['students_end_count']) ? (int) $row['students_end_count'] : 0;
            $row['price_per_student']    = isset($row['price_per_student']) ? (int) $row['price_per_student'] : 0;
        }
        unset($row);

        $this->merge(['stats' => $stats]);
    }
}
