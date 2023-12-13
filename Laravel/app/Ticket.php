<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Technician_Ticket;
use App\Comment;
use App\User;
use App\Ticket_Status;
use App\Ticket_Category;
use App\Ticket_Prio;
use App\Ticket_History;

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

    public function Ticket_Status()
    {
        return $this->belongsTo(Ticket_Status::class);
    }

    public function Ticket_Category()
    {
        return $this->belongsTo(Ticket_Category::class);
    }

    public function Ticket_Prio()
    {
        return $this->belongsTo(Ticket_Prio::class);
    }

    public function Ticket_History()
    {
        return $this->hasMany(\App\Ticket_History::class);
    }
}
