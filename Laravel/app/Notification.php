<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notification_Type;
use App\Notification_User;

class Notification extends Model
{
    protected $fillable = [
        'description',
        'object_id',
    ];

    use SoftDeletes;

    public function Notification_Type()
    {
        return $this->belongsTo(Notification_Type::class);
    }

    public function Notification_User()
    {
        return $this->hasMany(Notification_User::class);
    }
}
