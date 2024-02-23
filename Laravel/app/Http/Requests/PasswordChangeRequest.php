<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordChangeRequest extends FormRequest
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
            'password' => [
                'required',
                'confirmed',
                'string',
                'min:7',
                'max:20',
                'regex:/^(?=.*[A-Z])(?=.*[!@#$%^&*(),.?":{}|<>]).*$/'
            ],
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'A password é obrigatória!',
            'password.confirmed' => 'As passwords não coincidem!',
            'password.regex' => 'A password deve ter pelo menos uma letra maiúscula, um caracter especial e sete caracteres!',
            'password.min' => 'A password deve ter pelo menos uma letra maiúscula, um caracter especial e sete caracteres!',
            'password.max' => 'A password deve no máximo vinte caracteres!',
        ];
    }
}
