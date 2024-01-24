<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseClassRequest extends FormRequest
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
            'description' => 'required|string|min:5|max:15',
            'course_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'description.required' => 'A descrição é obrigatória!',
            'description.string' => 'Formato inválido!',
            'description.min' => 'A descrição deve ter pelo menos 5 caracteres!',
            'description.max' => 'A descrição deve ter no máximo 20 caracteres!',
            'course_id.required' => 'O campo de curso é obrigatório!',
        ];
    }
}
