<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Ticket;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket_Priority extends Model
{
    protected $fillable = [
        'description',
        'default_dueByDate'
    ];

    use SoftDeletes;

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
