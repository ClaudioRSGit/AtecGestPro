<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketUser extends Model
{
    protected $fillable = [
        'ticket_id',
        'user_id',
    ];

    public function tickets()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
