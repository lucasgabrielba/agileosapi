<?php

namespace App\Http\Requests\Orders\Items;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItemRequest extends FormRequest
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
            'type' => 'sometimes|required|string|max:255',
            'model' => 'sometimes|required|string|max:255',
            'serial' => 'sometimes|required|string|max:255',
            'brand' => 'sometimes|required|string|max:255',
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
        ];
    }
}
