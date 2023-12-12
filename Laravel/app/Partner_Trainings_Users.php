<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Partner;
use App\Training;
use App\User;

class Partner_Trainings_Users extends Model
{
    use SoftDeletes;

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    public function training()
    {
        return $this->belongsTo(Training::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
