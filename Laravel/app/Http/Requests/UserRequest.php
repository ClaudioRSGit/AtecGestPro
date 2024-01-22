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
        return [
            'name' => 'required|string|min:5|max:255',
            'username' => 'required|string|min:5|max:20',
            'email' => 'required|email',
            'contact' => 'required|min:9|max:20',
            'password' => [
                $this->input('password') != null ? 'required' : 'nullable',
                'string',
                'min:7',
                'regex:/^(?=.*[A-Z])(?=.*[!@#$%^&*(),.?":{}|<>]).*$/',
            ],
            'isStudent' => 'required',
            'isActive' => 'required',
            'course_class_id' => 'nullable',
            'role_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O nome é obrigatório!',
            'username.required' => 'O nome de usuário é obrigatório!',
            'email.required' => 'O email é obrigatório!',
            'email.email' => 'O email deve ser um endereço de email válido!',
            'contact.required' => 'O contato é obrigatório!',
        ];
    }
}
