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
        $yearMin = 2020;
        $yearMax = (int) now()->year + 10;

        return [
            'center_id'    => ['required', 'integer', 'exists:centers,id'],
            'professor_id' => ['nullable', 'integer', 'exists:professors,id'],
            'level_code'   => ['required', 'string', Rule::in(Group::LEVELS)],
            'year'         => ['required', 'integer', 'min:'.$yearMin, 'max:'.$yearMax],
            'group_status' => ['required', 'string', Rule::in(Group::STATUSES)],

            // ✅ En update aussi : on valide les rows mensuelles
            'stats' => ['required', 'array', 'min:1'],
            'stats.*.id' => ['nullable', 'integer', 'exists:group_monthly_stats,id'],
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

            // ✅ end <= start
            foreach ($stats as $i => $row) {
                $start = (int) ($row['students_start_count'] ?? 0);
                $end   = (int) ($row['students_end_count'] ?? 0);

                if ($end > $start) {
                    $v->errors()->add("stats.$i.students_end_count", "La fin ne peut pas dépasser le début (ligne ".($i+1).").");
                }
            }

            // ✅ pas de mois dupliqués
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

        if ($this->input('professor_id') === '' || $this->input('professor_id') === null) {
            $this->merge(['professor_id' => null]);
        }

        // ✅ normaliser stats + re-index
        $stats = array_values((array) $this->input('stats', []));

        foreach ($stats as &$row) {
            $row['id'] = isset($row['id']) ? (int) $row['id'] : null;
            $row['month'] = isset($row['month']) ? (int) $row['month'] : null;
            $row['students_start_count'] = isset($row['students_start_count']) ? (int) $row['students_start_count'] : 0;
            $row['students_end_count']   = isset($row['students_end_count']) ? (int) $row['students_end_count'] : 0;
            $row['price_per_student']    = isset($row['price_per_student']) ? (int) $row['price_per_student'] : 0;
        }
        unset($row);

        $this->merge(['stats' => $stats]);
    }
}
