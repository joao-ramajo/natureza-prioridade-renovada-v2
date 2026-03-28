<?php

namespace App\CollectionPoint\Infrastructure\Http\Requests;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateCollectionPointRequest extends ApiFormRequest
{
    public function authorize(): bool
    {
        // Autorização de ownership fica no use case / policy
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
}
