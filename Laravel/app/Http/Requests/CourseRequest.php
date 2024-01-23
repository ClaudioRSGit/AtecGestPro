<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
            'code' => 'required|string|min:2|max:15',
            'description' => 'required|string|min:10|max:100',
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'O código é obrigatório!',
            'code.min' => 'O código deve ter no miniimo 2 caracteres!',
            'code.max' => 'O código deve ter no máximo 15 caracteres!',
            'description.required' => 'A descrição é obrigatória!',
            'description.min' => 'A descrição deve ter no mínimo 10 caracteres!',
            'description.max' => 'A descrição deve ter no máximo 100 caracteres!',
        ];
    }
}
