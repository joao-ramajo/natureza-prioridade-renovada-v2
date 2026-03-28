<?php

namespace App\CollectionPoint\Infrastructure\Http\Requests;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Support\Facades\Auth;

class ReproveCollectionPointRequest extends ApiFormRequest
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
            'reason' => 'required|string|max:120'
        ];
    }
}
