<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRecipeRequest extends FormRequest
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
            'recipeName' => 'required',
            'description' => 'required',
            'amount.*' => 'required'
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'recipeName.required' => 'Field is empty',
            'description.required' => 'Field is empty',
            'amount.*.required' => 'Field amount is empty'
        ];
    }
}
