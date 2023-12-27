<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Technician_Ticket;
use App\Comment;
use App\User;
use App\Ticket_Status;
use App\Ticket_Category;
use App\Ticket_Priority;
use App\Ticket_History;

class Ticket extends Model
{
    protected $fillable = [
        'title',
        'description',
        'dueByDate',
        'attachment',
    ];

    use SoftDeletes;

    public function Technician_Ticket()
    {
        return $this->hasMany(Technician_Ticket::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
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
        return $this->belongsTo(Ticket_Priority::class);
    }

    public function Ticket_History()
    {
        return $this->hasMany(Ticket_History::class);
    }
}
