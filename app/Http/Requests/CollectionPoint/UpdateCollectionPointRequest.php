<?php

namespace App\Http\Requests\CollectionPoint;

use Illuminate\Foundation\Http\FormRequest;
use App\Enum\CollectionPointCategories;
use Illuminate\Support\Facades\Auth;

class UpdateCollectionPointRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Autorização de ownership fica na Action / Policy
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'name'        => ['sometimes', 'string', 'min:3', 'max:255'],
            'description' => ['sometimes', 'nullable', 'string'],

            'category' => [
                'sometimes',
                'string',
            ],

            'address'  => ['sometimes', 'string', 'max:255'],
            'city'     => ['sometimes', 'string', 'max:100'],
            'state'    => ['sometimes', 'string', 'size:2'],
            'zip_code' => ['sometimes', 'string', 'max:20'],
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('state')) {
            $this->merge([
                'state' => strtoupper($this->state),
            ]);
        }
    }
}
