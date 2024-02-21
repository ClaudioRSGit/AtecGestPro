<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class PartnerRequest extends FormRequest
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
        $partnerId = $this->partner ? $this->partner->id : null;

        return [
            'name' => ['required', 'string', 'max:100', 'unique:partners,name,' . $partnerId],
            'description' => 'required|string|max:200',
            'address' => 'required|string|max:100',
            'contact_value.*' => [
                'nullable',
                'min:9',
                'max:20',
                'regex:/^[\s\d()+-]+$/',
                function ($attribute, $value, $fail) use ($partnerId) {
                    if (!is_null($value)) {
                        \DB::beginTransaction();
                        try {
                            $exists = \DB::table('contact_partners')
                                ->where('contact', $value)
                                ->where('partner_id', '<>', $partnerId)
                                ->exists();

                            if ($exists) {
                                \DB::rollBack();
                                $fail('O contacto já existe!');
                            }
                        } catch (\Exception $e) {
                            \DB::rollBack();
                            $fail('Erro ao validar o contacto!');
                        }
                        \DB::commit();
                    }
                },
            ],
            'contact_description.*' => 'nullable|string|max:50',
            'existing_contact_values.*' => [
                'nullable',
                'min:9',
                'max:20',
                'regex:/^[\s\d()+-]+$/',
                function ($attribute, $value, $fail) use ($partnerId) {
                    if (!is_null($value)) {
                        \DB::beginTransaction();
                        try {
                            $exists = \DB::table('contact_partners')
                                ->where('contact', $value)
                                ->where('partner_id', '<>', $partnerId)
                                ->exists();

                            if ($exists) {
                                \DB::rollBack();
                                $fail('O contacto já existe!');
                            }
                        } catch (\Exception $e) {
                            \DB::rollBack();
                            $fail('Erro ao validar o contacto!');
                        }
                        \DB::commit();
                    }
                },
            ],
            'existing_contact_descriptions.*' => 'nullable|string|max:50',

            'new_contact_values.*' => [
                'nullable',
                'min:9',
                'max:20',
                'regex:/^[\s\d()+-]+$/',
                function ($attribute, $value, $fail) use ($partnerId) {
                    if (!is_null($value)) {
                        \DB::beginTransaction();
                        try {
                            $exists = \DB::table('contact_partners')
                                ->where('contact', $value)
                                ->where('partner_id', '<>', $partnerId)
                                ->exists();

                            if ($exists) {
                                \DB::rollBack();
                                $fail('O contacto já existe!');
                            }
                        } catch (\Exception $e) {
                            \DB::rollBack();
                            $fail('Erro ao validar o contacto!');
                        }
                        \DB::commit();
                    }
                },
            ],
            'new_contact_descriptions.*' => 'nullable|string|max:50',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O nome é obrigatório!',
            'name.max' => 'O nome deve ter no máximo 100 caracteres!',
            'name.unique' => 'O nome já existe!',

            'description.required' => 'A descrição é obrigatória!',
            'description.max' => 'A descrição deve ter no máximo 200 caracteres!',

            'address.required' => 'O endereço é obrigatório!',
            'address.max' => 'O endereço deve ter no máximo 100 caracteres!',

            'contact_value.*.min' => 'O contacto deve ter pelo menos 9 caracteres!',
            'contact_value.*.max' => 'O contacto deve ter no máximo 20 caracteres!',
            'contact_value.*.regex' => 'Formato de contacto inválido!',
            'contact_description.*.max' => 'A descrição deve ter no máximo 50 caracteres!',

            'existing_contact_values.*.min' => 'O contacto deve ter pelo menos 9 caracteres!',
            'existing_contact_values.*.max' => 'O contacto deve ter no máximo 20 caracteres!',
            'existing_contact_values.*.regex' => 'Formato de contacto inválido!',
            'existing_contact_descriptions.*.max' => 'A descrição deve ter no máximo 50 caracteres!',

            'new_contact_values.*.min' => 'O novo contacto deve ter pelo menos 9 caracteres!',
            'new_contact_values.*.max' => 'O novo contacto deve ter no máximo 20 caracteres!',
            'new_contact_values.*.regex' => 'Formato do novo contacto inválido!',
            'new_contact_descriptions.*.max' => 'A descrição do novo contacto deve ter no máximo 50 caracteres!',
        ];
    }
}
