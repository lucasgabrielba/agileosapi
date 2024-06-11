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
            'internal_notes' => 'nullable|string',
            'problem_description' => 'sometimes|required|string',
            'budget_description' => 'nullable|string',
            'estimated_date' => 'nullable|date',
            'end_of_warranty_date' => 'nullable|date',
            'is_reentry' => 'sometimes|required|boolean',
            'priority' => 'sometimes|required|in:normal,high',
            'status' => 'sometimes|required|string|max:255',
            'attachments' => 'nullable|json',
        ];
    }

    /**
     * Customize the error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'number.required' => 'O número da ordem é obrigatório.',
            'problem_description.required' => 'A descrição do problema é obrigatória.',
            'created_at.required' => 'A data de criação é obrigatória.',
            'is_reentry.required' => 'É necessário informar se é uma reentrada.',
            'priority.required' => 'A prioridade é obrigatória.',
            'priority.in' => 'A prioridade deve ser normal ou high.',
            'status.required' => 'O status é obrigatório.',
        ];
    }
}
