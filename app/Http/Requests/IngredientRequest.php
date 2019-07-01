<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IngredientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ingredientName' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'ingredientName.required' => 'Field ingredient name is empty',
            'ingredientName.string' => 'Field ingredient name is not a string'
        ];
    }
}