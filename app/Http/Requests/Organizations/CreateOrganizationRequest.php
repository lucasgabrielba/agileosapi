<?php

namespace App\Http\Requests\Organizations;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrganizationRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phones' => 'required|array',
            'document' => 'nullable|string|max:255',
            'status' => 'required|string|max:255',
        ];
    }
}
