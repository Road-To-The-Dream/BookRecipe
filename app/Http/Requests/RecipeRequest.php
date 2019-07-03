<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecipeRequest extends FormRequest
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
            'recipeName' => 'required',
            'description' => 'required',
            'amount.*' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'recipeName.required' => 'Field is empty',
            'description.required' => 'Field is empty',
            'amount.*.required' => 'Field amount is empty'
        ];
    }
}
