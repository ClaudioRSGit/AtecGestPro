<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Course;
use App\User;

class CourseClass extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'description',
        'course_id'
    ];
    public function students()
    {
        return $this->hasMany(User::class, 'course_class_id');
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function users()
    {
        return $this->hasMany(\App\User::class);
    }
}
