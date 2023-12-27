<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Ticket_History;
use Illuminate\Database\Eloquent\SoftDeletes;

class Email extends Model
{
    protected $fillable = [
        'recipient_email',
        'subject',
        'message',
    ];

    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function Ticket_History()
    {
        return $this->belongsTo(Ticket_History::class);
    }
}
