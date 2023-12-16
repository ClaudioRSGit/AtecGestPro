<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Role;
use App\User;

class Role_User extends Model
{

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function user()
    {
        return $this->belongsTo(Role::class);
    }
}
