<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaterialRequest extends FormRequest
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
                'name' => 'required|string|min:3|max:50',
                'description' => 'nullable|string|min:3|max:200',
                'supplier' => 'nullable|string|min:3|max:50',
                'acquisition_date' => 'nullable|date',
                'isInternal' => 'required|boolean',
                'isClothing' => 'required|boolean',
                'gender' => 'nullable|boolean',
                'quantity' => 'nullable|integer|min:0',
                'sizes' => ['nullable', 'array'],
                'sizes.*' => ['nullable', 'string', 'max:10'],
                'stocks' => ['nullable', 'array'],
                'stocks.*' => ['nullable', 'integer', 'min:0'],
                'courses' => ['nullable', 'array'],
                'courses.*' => ['nullable', 'integer', 'min:1'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O nome é obrigatório!',
            'name.string' => 'Formato inválido!',
            'name.min' => 'O nome deve ter pelo menos 3 caracteres!',
            'name.max' => 'O nome não pode ter mais de 50 caracteres!',

            'description.string' => 'Formato inválido!',
            'description.min' => 'A descrição deve ter pelo menos 3 caracteres!',
            'description.max' => 'A descrição não pode ter mais de 200 caracteres!',

            'supplier.string' => 'Formato inválido!',
            'supplier.min' => 'O nome do fornecedor deve ter pelo menos 3 caracteres!',
            'supplier.max' => 'O nome do fornecedor não pode ter mais de 50 caracteres!',
        ];
    }
}
