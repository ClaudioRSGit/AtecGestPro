<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Ticket;

class Ticket_Category extends Model
{
    public function tickets()
    {
        return $this->hasMany(\App\Ticket::class);
    }
}
