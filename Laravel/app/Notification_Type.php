<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Notification;

class Notification_Type extends Model
{
    protected $fillable = [
        'description',
        'code'
    ];

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
