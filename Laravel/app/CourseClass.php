<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseClass extends Model
{
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
