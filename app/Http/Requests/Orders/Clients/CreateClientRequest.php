<?php

namespace App\Http\Requests\Orders\Clients;

use Illuminate\Foundation\Http\FormRequest;

class CreateClientRequest extends FormRequest
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
            'email' => 'required|email|unique:clients,email',
            'phones' => ['required', 'array', new UniquePhone],
            'document' => 'required|string|max:20|unique:clients,document',
        ];
    }

    /**
     * Customize the error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'O e-mail deve ser um endereço de e-mail válido.',
            'email.unique' => 'Este e-mail já está sendo usado.',
            'phones.required' => 'O telefone é obrigatório.',
            'phones.array' => 'O telefone deve ser um array válido.',
            'document.required' => 'O documento é obrigatório.',
            'document.max' => 'O documento não pode exceder 20 caracteres.',
            'document.unique' => 'Este documento já está sendo usado.',
        ];
    }
}
