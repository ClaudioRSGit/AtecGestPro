<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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

        $courseClassId = $this->course_id ? $this->course_id : null;

        return [

            'description' => ['required', 'string', 'min:5', 'max:15', 'unique:course_classes,description,' . $courseClassId],
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
            'description.unique' => 'Já existe uma turma com essa descrição!',
        ];
    }
}
