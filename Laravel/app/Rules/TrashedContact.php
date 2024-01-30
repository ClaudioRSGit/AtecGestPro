<?php

namespace App\Rules;

use App\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Validation\Concerns\ValidatesAttributes;

class TrashedContact implements Rule
{
    use ValidatesAttributes;

    protected $message = '';
    protected $implicitAttributes = [];
    protected $currentRule;

    public function passes($attribute, $value)
    {
        $user = User::withTrashed()->where('contact', $value)->first();

        if (!$user) {
            return true;
        }

        if ($user->trashed()) {
            $this->message = 'O contacto que introduziu pertence a um utilizador apagado. Pode recuperá-lo na reciclagem.';
            return false;
        }

        $this->message = 'O contacto já existe!';
        return false;
    }

    public function message()
    {
        return $this->message;
    }

    public function getPresenceVerifier()
    {
        return \Illuminate\Support\Facades\Validator::getFacadeRoot()->getPresenceVerifier();
    }
}
