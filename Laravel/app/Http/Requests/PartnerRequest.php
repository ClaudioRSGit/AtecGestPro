<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartnerRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:200',
            'address' => 'required|string|max:100',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O nome é obrigatório!',
            'name.max' => 'O nome deve ter no máximo 100 caracteres!',

            'description.required' => 'A descrição é obrigatória!',
            'description.max' => 'A descrição deve ter no máximo 200 caracteres!',

            'address.required' => 'O endereço é obrigatório!',
            'address.max' => 'O endereço deve ter no máximo 100 caracteres!',
        ];
    }
}
