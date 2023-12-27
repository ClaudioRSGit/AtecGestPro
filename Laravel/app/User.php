<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Email;
use App\Action;
use App\Technician_Ticket;
use App\Ticket;
use App\Comment;
use App\CourseClass;
use App\Role_User;
use App\Partner_Trainings_Users;
use App\Clothing_Delivery;
use App\Ticket_History;


class User extends Model
{
    protected $fillable = [
        'name',
        'username',
        'email',
        'contact',
        'password',
        'position',
        'isActive',
        'isStudent',
    ];

    use SoftDeletes;

    public function emails()
    {
        return $this->hasMany(Email::class);
    }

    public function actions()
    {
        return $this->hasMany(Action::class);
    }

    public function Technician_Ticket()
    {
        return $this->hasMany(Technician_Ticket::class);
    }

    public function Ticket()
    {
        return $this->hasMany(Ticket::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function CourseClass()
    {
        return $this->belongsTo(CourseClass::class, 'course_class_id');
    }

    public function Role_User()
    {
        return $this->hasMany(Role_User::class);
    }

    public function Partner_Trainings_Users()
    {
        return $this->hasMany(Partner_Trainings_Users::class);
    }

    public function Clothing_Delivery()
    {
        return $this->belongsTo(Clothing_Delivery::class);
    }

    public function Ticket_History()
    {
        return $this->hasMany(Ticket_History::class);
    }



}
