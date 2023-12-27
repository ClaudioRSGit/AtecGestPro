<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Email;
use App\Ticket;
use App\Action;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket_History extends Model
{
    protected $fillable = [
        'ticket_info',
    ];

    use SoftDeletes;

    public function email()
    {
        return $this->belongsTo(Email::class);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function actions()
    {
        return $this->hasMany(Action::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
