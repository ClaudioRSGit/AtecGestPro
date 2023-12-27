<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Ticket_History;

class Action extends Model
{
    protected $fillable = [
        'description',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function Ticket_History()
    {
        return $this->belongsTo(Ticket_History::class);
    }
}
