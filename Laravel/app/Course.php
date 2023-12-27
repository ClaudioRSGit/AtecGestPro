<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\CourseClass;

class Course extends Model
{
    protected $fillable = [
        'code',
        'description'
    ];
    
    use SoftDeletes;

    public function CourseClass()
    {
        return $this->hasMany(CourseClass::class);
    }
}
