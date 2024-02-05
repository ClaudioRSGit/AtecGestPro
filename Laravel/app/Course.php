<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use softDeletes;

    protected $guarded = [

    ];


    public function materials()
    {
        return $this->belongsToMany(Material::class)->using(CourseMaterial::class);
    }

    public function courseClasses()
    {
        return $this->hasMany(CourseClass::class);
    }

}
