<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaterialUserRequest extends FormRequest
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
            'selectedClothing' => 'required|array',
            'user_id' => 'required',
            'quantity' => 'required|array',
            'material_size_id' => 'required|array',
            'delivery_date' => 'required|array',
            'delivered_all' => 'required',
        ];
    }
}
