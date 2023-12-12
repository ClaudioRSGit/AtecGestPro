<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Technician_Ticket;
use App\Comment;
use App\User;

class Ticket extends Model
{
    use SoftDeletes;

    public function Technician_Ticket()
    {
        return $this->hasMany(\App\Technician_Ticket::class);
    }

    public function comments()
    {
        return $this->hasMany(\App\Comment::class);
    }

    public function users()
    {
        return $this->hasMany(\App\Users::class);
    }
}
