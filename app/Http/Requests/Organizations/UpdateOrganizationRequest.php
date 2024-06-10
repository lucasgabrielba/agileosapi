<?php

namespace App\Http\Requests\Organizations;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrganizationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|max:255',
            'phones' => 'sometimes|required|array',
            'document' => 'sometimes|required|string|max:255',
            'status' => 'sometimes|required|string|max:255',
        ];
    }
}
