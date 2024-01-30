<?php

namespace App\Rules;

use App\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Validation\Concerns\ValidatesAttributes;

class TrashedEmail implements Rule
{
    use ValidatesAttributes;

    protected $message = '';
    protected $implicitAttributes = [];
    protected $currentRule;
    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function passes($attribute, $value)
    {
        $user = User::withTrashed()->where('email', $value)->where('id', '!=', $this->userId)->first();

        if (!$user) {
            return true;
        }

        if ($user->trashed()) {
            $this->message = 'O email que introduziu pertence a um utilizador apagado. Pode recuperá-lo na reciclagem.';
            return false;
        }

        $this->message = 'O email já existe!';
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
