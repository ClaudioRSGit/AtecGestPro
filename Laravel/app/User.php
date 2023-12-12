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


class User extends Model
{
    use SoftDeletes;

    public function emails()
    {
        return $this->hasMany(\App\Email::class);
    }

    public function actions()
    {
        return $this->hasMany(\App\Action::class);
    }

    public function Technician_Ticket()
    {
        return $this->hasMany(\App\Technician_Ticket::class);
    }

    public function Ticket()
    {
        return $this->hasMany(\App\Ticket::class);
    }

    public function comments()
    {
        return $this->hasMany(\App\Comment::class);
    }

    public function CourseClass()
    {
        return $this->hasMany(\App\CourseClass::class);
    }

    public function Role_User()
    {
        return $this->hasMany(\App\Role_User::class);
    }

    public function Partner_Trainings_Users()
    {
        return $this->hasMany(\App\Partner_Trainings_Users::class);
    }

}
