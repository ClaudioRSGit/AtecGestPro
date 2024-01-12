<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'username','name', 'email', 'password', 'role_id', 'phone', 'address', 'city', 'state', 'zip', 'country', 'image'
    ];
}
