<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Role_User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    use SoftDeletes;

    public function Role_User()
    {
        return $this->hasMany(Role_User::class);
    }
}
