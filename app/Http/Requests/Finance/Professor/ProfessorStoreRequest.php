<?php

namespace App\Http\Requests\Finance\Professor;

use Illuminate\Foundation\Http\FormRequest;

class ProfessorStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'center_id' => ['required', 'exists:centers,id'],
            'name'      => ['required', 'string', 'max:190'],
            'active'    => ['nullable', 'boolean'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'active' => $this->boolean('active'),
        ]);
    }
}
