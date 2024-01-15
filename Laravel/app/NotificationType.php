<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationType extends Model
{
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
