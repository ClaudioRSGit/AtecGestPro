<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Notification;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification_User extends Model
{
    protected $fillable = [
        'isRead',
    ];

    use SoftDeletes;

    public function notification()
    {
        return $this->belongsTo(Notification::class);
    }
}
