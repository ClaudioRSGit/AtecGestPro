<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public function notificationType()
    {
        return $this->belongsTo(NotificationType::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'notification_users')->withPivot('is_read')->withTimestamps();
    }
}
