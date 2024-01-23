<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string|min:3|max:200',
            'username' => 'required|string|min:5|max:20',
            'email' => 'required|email',
            'contact' => 'required|min:9|max:20|regex:/^[\s\d()+-]+$/',
            'isStudent' => 'required',
            'isActive' => 'required',
            'course_class_id' => 'nullable',
            'role_id' => 'required',
        ];

        if ($this->input('role_id') != 3 && !$this->isMethod('put')) {
            $rules['password'] = [
                'required',
                'string',
                'min:7',
                'regex:/^(?=.*[A-Z])(?=.*[!@#$%^&*(),.?":{}|<>]).*$/',
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'O nome é obrigatório!',
            'name.min' => 'O nome deve ter pelo menos 5 caracteres!',
            'name.max' => 'O nome deve ter no máximo 200 caracteres!',

            'username.required' => 'O username é obrigatório!',
            'username.min' => 'O username deve ter pelo menos 5 caracteres!',
            'username.max' => 'O username deve ter no máximo 20 caracteres!',

            'email.required' => 'O email é obrigatório!',
            'email.email' => 'Formato de email inválido!',

            'contact.required' => 'O contato é obrigatório!',
            'contact.min' => 'O contato deve ter pelo menos 9 caracteres!',
            'contact.max' => 'O contato deve ter no máximo 20 caracteres!',
            'contact.regex' => 'Formato de contacto inválido!',

            'password.required' => 'A password é obrigatória!',
            'password.regex' => 'A password deve ter pelo menos uma letra maiúscula, um caracter especial e sete caracteres!',
        ];
    }
}