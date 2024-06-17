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
            'type' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'serial' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'organization' => 'required|exists:organizations,id',
            'client_id' => 'required|exists:clients,id',
        ];
    }

    /**
     * Customize the error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'type.required' => 'O tipo é obrigatório.',
            'model.required' => 'O modelo é obrigatório.',
            'serial.required' => 'O número de série é obrigatório.',
            'brand.required' => 'A marca é obrigatória.',
            'organization.required' => 'A organização é obrigatória.',
            'organization.exists' => 'A organização fornecida não existe.',
            'client.required' => 'O cliente é obrigatório.',
            'client.exists' => 'O cliente fornecido não existe.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'organization' => $this->route('organization'),
        ]);
    }
}
