<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $fillable = [
        'recipient_email',
        'subject',
        'message',
        'ticket_history_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ticketHistory()
    {
        return $this->belongsTo(TicketHistory::class);
    }
}
