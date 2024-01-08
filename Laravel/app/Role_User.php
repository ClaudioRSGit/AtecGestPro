<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Role;
use App\User;

class Role_User extends Model
{

    protected $fillable = [
        'role_id',
        'user_id',
    ];
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
