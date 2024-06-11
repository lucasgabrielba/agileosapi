<?php

namespace App\Http\Requests\Orders\Orders;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
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
            'email' => 'sometimes|email|unique:users,email,',
            'password' => 'sometimes|nullable|string|min:8|confirmed',
            'password_confirmation' => 'sometimes|string|min:8|same:password',
            'status' => 'sometimes|string|in:active,inactive',
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
            'email.unique' => 'Este e-mail já está sendo usado.',
            'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
            'password_confirmation.min' => 'A confirmação de senha deve ter pelo menos 8 caracteres.',
            'password.same' => 'A senha e a confirmação de senha devem ser iguais.',
            'status.in' => 'O status deve ser active ou inactive.',
        ];
    }
}
