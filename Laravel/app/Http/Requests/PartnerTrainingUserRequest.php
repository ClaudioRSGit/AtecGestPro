<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartnerTrainingUserRequest extends FormRequest
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
            'partner_id' => 'required',
            'training_id' => 'required',
            'user_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required|after_or_equal:start_date',
        ];
    }

    public function messages()
    {
        return [
            'start_date.required' => 'Mencionar a data inicial é obrigatório!',
            'end_date.required' => 'Mencionar a data final é obrigatório!',
            'end_date.after_or_equal' => 'A data final deve ser igual ou posterior à data inicial!',
        ];
    }
}
