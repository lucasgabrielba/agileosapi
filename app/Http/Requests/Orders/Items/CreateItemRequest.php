<?php

namespace App\Http\Requests\Orders\Items;

use Illuminate\Foundation\Http\FormRequest;

class CreateItemRequest extends FormRequest
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
            'type' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'serial' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'client_id' => 'required|exists:clients,id',
            'organization_id' => 'required|exists:organizations,id',
        ];
    }

    /**
     * Customize the error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'type.required' => 'O tipo é obrigatório.',
            'model.required' => 'O modelo é obrigatório.',
            'serial.required' => 'O número de série é obrigatório.',
            'brand.required' => 'A marca é obrigatória.',
            'client_id.required' => 'O cliente é obrigatório.',
            'client_id.exists' => 'O cliente selecionado não existe.',
            'organization_id.required' => 'A organização é obrigatória.',
            'organization_id.exists' => 'A organização selecionada não existe.',
        ];
    }
}
