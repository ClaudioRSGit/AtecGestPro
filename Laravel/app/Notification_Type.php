<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Notification;

class Notification_Type extends Model
{
    public function notifications()
    {
        return $this->hasMany(\App\Notification::class);
    }
}
