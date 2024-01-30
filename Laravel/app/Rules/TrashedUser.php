<?php

namespace App\Rules;

use App\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Validation\Concerns\ValidatesAttributes;
use Illuminate\Validation\Validator;

class TrashedUser implements Rule
{
    use ValidatesAttributes;

    protected $message = '';
    protected $implicitAttributes = [];
    protected $currentRule;

    public function passes($attribute, $value)
    {
        $user = User::withTrashed()->where('username', $value)->first();

        if (!$user) {
            return true;
        }

        if ($user->trashed()) {
            $this->message = 'O username que introduziu pertence a um utilizador apagado. Pode recuperá-lo na reciclagem.';
            return false;
        }

        $this->message = 'O username já existe!';
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
