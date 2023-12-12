<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Partner_Trainings_Users;

class Partner extends Model
{
    use SoftDeletes;

    public function Partner_Trainings_Users()
    {
        return $this->hasMany(\App\Partner_Trainings_Users::class);
    }
}
