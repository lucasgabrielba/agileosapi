<?php

namespace App\Http\Requests\Orders\Orders;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
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
            'client.name' => 'required|string|max:255',
            'client.email' => 'nullable|email',
            'client.phones' => 'required|array',
            'client.document' => 'nullable|string|max:255',

            'client.address' => 'nullable|array',
            'client.address.street' => 'nullable|string',
            'client.address.number' => 'nullable|string',
            'client.address.complement' => 'nullable|string',
            'client.address.district' => 'nullable|string',
            'client.address.city' => 'nullable|string',
            'client.address.state' => 'nullable|string',
            'client.address.country' => 'nullable|string',
            'client.address.postal_code' => 'nullable|string',
            'client.address.reference' => 'nullable|string',

            'items' => 'nullable|array',
            'items.*.type' => 'nullable|string',
            'items.*.model' => 'nullable|string',
            'items.*.brand' => 'nullable|string',
            'items.*.serial' => 'nullable|string',

            'problem_description' => 'required|string',
            'priority' => 'nullable|in:normal,high',
            'attachments' => 'nullable|json',
        ];
    }

    /**
     * Customize the error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'client.name.required' => 'O nome do cliente é obrigatório.',
            'client.phones.required' => 'O telefone do cliente é obrigatório.',

            'problem_description.required' => 'A descrição do problema é obrigatória.',
            'priority.required' => 'A prioridade é obrigatória.',
            'priority.in' => 'A prioridade deve ser normal ou high.',
        ];
    }
}
