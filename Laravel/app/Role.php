<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Role_User;

class Role extends Model
{
    public function Role_User()
    {
        return $this->hasMany(\App\Role_User::class);
    }
}
