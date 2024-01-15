<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function actions()
    {
        return $this->hasMany(Action::class);
    }

    public function courseClass()
    {
        return $this->belongsTo(CourseClass::class);
    }

    public function role()
    {
        return $this->hasOne(Role::class);
    }


}
