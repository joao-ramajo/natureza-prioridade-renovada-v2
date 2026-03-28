<?php

namespace App\CollectionPoint\Infrastructure\Http\Requests;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Support\Facades\Auth;

class CreateCollectionPointRequest extends ApiFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:100'],
            'state' => ['required', 'string', 'size:2'],
            'zip_code' => ['required', 'string', 'max:9'],
            'description' => ['nullable', 'string'],
            'principal_image' => 'file|required',
            'images' => ['nullable', 'array'],
            'images.*' => ['file', 'image']
        ];
    }
}
