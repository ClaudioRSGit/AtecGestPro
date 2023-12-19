<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\CourseClass;

class Course extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'code',
        'description'
    ];

    public function CourseClass()
    {
        return $this->hasMany(\App\CourseClass::class);
    }
}
