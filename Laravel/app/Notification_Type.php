<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Notification;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification_Type extends Model
{
    protected $fillable = [
        'description',
        'code'
    ];

    use SoftDeletes;

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
