<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Partner;
use App\Training;
use App\User;
use App\Material_Training;

class Partner_Training_User extends Model
{
    protected $fillable = [
        'partner_id',
        'training_id',
        'user_id',
        'start_date',
        'end_date'
    ];

    use SoftDeletes;

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    public function Material_Training()
    {
        return $this->hasMany(Material_Training::class, 'partner__training__users_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function training()
    {
        return $this->belongsTo(Training::class);
    }


}
