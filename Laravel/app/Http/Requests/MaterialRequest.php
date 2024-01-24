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
                'name' => 'required|string|max:255',
                'description' => 'nullable|string|max:500',
                'supplier' => 'nullable|string|max:255',
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
}
