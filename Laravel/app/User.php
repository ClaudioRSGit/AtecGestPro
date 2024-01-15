<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function actions()
    {
        return $this->hasMany(Action::class);
    }
}
