<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Ticket;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket_Status extends Model
{
    protected $fillable = [
        'description',
    ];

    use SoftDeletes;

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
