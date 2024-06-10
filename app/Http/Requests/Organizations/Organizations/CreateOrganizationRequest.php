<?php

namespace App\Http\Requests\Organizations\Organizations;

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

    /**
     * Customize the error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'name.string' => 'O nome deve ser uma string.',
            'name.max' => 'O nome deve ter no máximo 255 caracteres.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'O e-mail deve ser um endereço de e-mail válido.',
            'email.max' => 'O e-mail deve ter no máximo 255 caracteres.',
            'phones.required' => 'Os telefones são obrigatórios.',
            'phones.array' => 'Os telefones devem ser um array.',
            'document.string' => 'O documento deve ser uma string.',
            'document.max' => 'O documento deve ter no máximo 255 caracteres.',
            'status.required' => 'O status é obrigatório.',
            'status.string' => 'O status deve ser uma string.',
            'status.max' => 'O status deve ter no máximo 255 caracteres.',
        ];
    }
}
