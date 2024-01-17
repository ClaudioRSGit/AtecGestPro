<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketHistory extends Model
{
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function action()
    {
        return $this->belongsTo(Action::class);
    }
}
