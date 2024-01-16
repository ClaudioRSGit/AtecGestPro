<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseClass extends Model
{

    protected $guarded = [

    ];
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function students()
    {
        return $this->hasMany(User::class)->where('isStudent', true);
    }
}
