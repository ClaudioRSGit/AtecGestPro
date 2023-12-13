<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Ticket_History;

class Email extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function Ticket_History()
    {
        return $this->belongsTo(Ticket_History::class);
    }
}
