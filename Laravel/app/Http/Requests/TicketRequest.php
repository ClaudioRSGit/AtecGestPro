<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
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
            'title' => 'required|string|min:2|max:50',
            'description' => 'required|string|min:5|max:2000',
            'technician_id' => 'required|exists:users,id',
            'attachment' => 'sometimes|file|mimes:jpeg,jpg,png,gif,svg,bmp,raw,pdf,doc,docx,xls,xlsm,xlsx|max:20480', // 20MB
            'priority_id' => 'required|exists:ticket_priorities,id',
            'category_id' => 'required|exists:ticket_categories,id',
        ];


        if ($this->isMethod('put')) {
            $rules = [
                // 'dueByDate' => 'required|date',
                'title' => 'required|string|min:2|max:50',
                'description' => 'required|string|min:5|max:2000',
                'technician_id' => 'required|exists:users,id',
                'attachment' => 'sometimes|file|mimes:jpeg,jpg,png,gif,svg,bmp,raw,pdf,doc,docx,xls,xlsm,xlsx|max:20480', // 20MB
                'ticket_status_id' => 'required|integer|exists:ticket_statuses,id',
                'ticket_priority_id' => 'required|integer|exists:ticket_priorities,id',
                'ticket_category_id' => 'required|integer|exists:ticket_categories,id',

            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'title.required' => 'O título é obrigatório!',
            'title.min' => 'O título deve conter no mínimo 2 caracteres!',
            'title.max' => 'O título deve conter no máximo 2000 caracteres!',
            'description.required' => 'A descrição é obrigatória!',
            'description.min' => 'A descrição deve conter no mínimo 5 caracteres!',
            'description.max' => 'Atingiu o limite de caracteres!',
            'description.string' => 'Formato inválido',
            'attachment.mimes' => 'Formato de arquivo inválido',
        ];
    }
}
