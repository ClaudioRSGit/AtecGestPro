<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function materials()
    {
        return $this->belongsToMany(Material::class)->using(CourseMaterial::class);
    }

    public function courseClasses()
    {
        return $this->hasMany(CourseClass::class);
    }

}
