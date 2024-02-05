<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrainingRequest extends FormRequest
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
            'name' => 'required|string|min:5|max:50',
            'description' => 'required|string|min:5|max:100',
            'category' => 'required|string|min:5|max:50',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O nome é obrigatório!',
            'name.string' => 'Formato inválido!',
            'name.min' => 'O nome deve ter pelo menos 5 caracteres!',
            'name.max' => 'O nome deve ter no máximo 50 caracteres!',

            'description.required' => 'A descrição é obrigatória!',
            'description.string' => 'Formato inválido!',
            'description.min' => 'A descrição deve ter pelo menos 5 caracteres!',
            'description.max' => 'A descrição deve ter no máximo 100 caracteres!',

            'category.required' => 'A categoria é obrigatória!',
            'category.string' => 'Formato inválido!',
            'category.min' => 'A categoria deve ter pelo menos 5 caracteres!',
            'category.max' => 'A categoria deve ter no máximo 50 caracteres!',
        ];
    }
}
