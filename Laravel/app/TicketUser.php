<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketUser extends Model
{
    public function tickets()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
