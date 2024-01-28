<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'description',
        'code',
        'object_id',
        'user_id',
    ];
    public function users()
    {
        return $this->belongsToMany(User::class, 'notification_users')->withPivot('is_read')->withTimestamps();
    }
}
