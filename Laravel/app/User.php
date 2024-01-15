<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use softDeletes;

    //all fillable fields
    protected $guarded = [

    ];
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
        return $this->belongsTo(Role::class);
    }


}
