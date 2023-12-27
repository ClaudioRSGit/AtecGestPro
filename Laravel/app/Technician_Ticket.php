<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Ticket;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Technician_Ticket extends Model
{
    use SoftDeletes;

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
