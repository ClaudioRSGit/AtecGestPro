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
        return [
            'user_id' => 'required|integer|exists:users,id',
            'title' => 'required|string|min:2|max:50',
            'description' => 'required|string|min:5|max:100',
            'technician_id' => 'required|exists:users,id',
            'dueByDate' => 'required|date',
            'attachment' => 'sometimes|file|max:20480', // 20MB
            'priority_id' => 'required|exists:ticket_priorities,id',
            'category_id' => 'required|exists:ticket_categories,id',
            'ticket_status_id' => 'required|integer|exists:ticket_statuses,id',
            'ticket_priority_id' => 'required|integer|exists:ticket_priorities,id',
            'ticket_category_id' => 'required|integer|exists:ticket_categories,id',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'O título é obrigatório!',
            'title.min' => 'O título deve conter no mínimo 2 caracteres!',
            'title.max' => 'O título deve conter no máximo 50 caracteres!',
            'description.required' => 'A descrição é obrigatória!',
            'description.min' => 'A descrição deve conter no mínimo 5 caracteres!',
            'description.max' => 'A descrição deve conter no máximo 100 caracteres!',
            'description.string' => 'Formato inválido',
        ];
    }
}
