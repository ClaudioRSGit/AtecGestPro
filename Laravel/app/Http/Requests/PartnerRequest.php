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
            'contact_value.*' => 'nullable|min:9|max:20|regex:/^[\s\d()+-]+$/',
            'contact_description.*' => 'nullable|string|max:50',
            'existing_contact_values.*' => 'nullable|min:9|max:20|regex:/^[\s\d()+-]+$/',
            'existing_contact_descriptions.*' => 'nullable|string|max:50',
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

            'contact_value.*.min' => 'O contato deve ter pelo menos 9 caracteres!',
            'contact_value.*.max' => 'O contato deve ter no máximo 20 caracteres!',
            'contact_value.*.regex' => 'Formato de contacto inválido!',
            'contact_description.*.max' => 'A descrição deve ter no máximo 50 caracteres!',

            'existing_contact_values.*.min' => 'O contato deve ter pelo menos 9 caracteres!',
            'existing_contact_values.*.max' => 'O contato deve ter no máximo 20 caracteres!',
            'existing_contact_values.*.regex' => 'Formato de contacto inválido!',
            'existing_contact_descriptions.*.max' => 'A descrição deve ter no máximo 50 caracteres!',
        ];
    }
}
