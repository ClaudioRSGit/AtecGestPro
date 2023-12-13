<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Notification;

class Notification_User extends Model
{
    public function notification()
    {
        return $this->belongsTo(Notification::class);
    }
}