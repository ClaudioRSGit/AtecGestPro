<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tickets;

class Ticket_Status extends Model
{
    public function tickets()
    {
        return $this->hasMany(\App\Ticket::class);
    }
}
