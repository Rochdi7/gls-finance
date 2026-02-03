<?php

namespace App\Http\Requests\Finance\Center;

use Illuminate\Foundation\Http\FormRequest;

class CenterStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'   => ['required', 'string', 'max:190'],
            'city'   => ['nullable', 'string', 'max:190'],
            'active' => ['nullable', 'boolean'],
        ];
    }

    protected function prepareForValidation(): void
    {
        // checkbox -> boolean
        if ($this->has('active')) {
            $this->merge(['active' => (bool) $this->boolean('active')]);
        }
    }
}
