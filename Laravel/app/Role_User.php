<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Role;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role_User extends Model
{
    use SoftDeletes;

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
