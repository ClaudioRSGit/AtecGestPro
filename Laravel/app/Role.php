<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Role_User;

class Role extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function Role_User()
    {
        return $this->hasMany(Role_User::class);
    }
}
