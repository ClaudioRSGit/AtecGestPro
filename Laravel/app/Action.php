<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Action extends Model
{
    //
    protected $fillable = ['description'];

    use softDeletes;

    public function tickeHistory ()
    {
        return $this->hasMany(TicketHistory::class);
    }

    public function partner()
    {
        return $this->belongsTo(User::class);
    }

}
