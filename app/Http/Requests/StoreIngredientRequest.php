<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreIngredientRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'ingredientName' => 'required|string'
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'ingredientName.required' => 'Field ingredient name is empty',
            'ingredientName.string' => 'Field ingredient name is not a string'
        ];
    }
}
