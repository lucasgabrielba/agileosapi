<?php

namespace App\Http\Requests\Organizations\Organizations;

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
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|max:255',
            'phones' => 'sometimes|array',
            'document' => 'sometimes|string|max:255',
            'status' => 'sometimes|string|max:255',
        ];
    }

    /**
     * Customize the error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'name.string' => 'O nome deve ser uma string.',
            'name.max' => 'O nome deve ter no máximo 255 caracteres.',
            'email.email' => 'O e-mail deve ser um endereço de e-mail válido.',
            'email.max' => 'O e-mail deve ter no máximo 255 caracteres.',
            'phones.array' => 'Os telefones devem ser um array.',
            'document.string' => 'O documento deve ser uma string.',
            'document.max' => 'O documento deve ter no máximo 255 caracteres.',
            'status.string' => 'O status deve ser uma string.',
            'status.max' => 'O status deve ter no máximo 255 caracteres.',
        ];
    }
}
