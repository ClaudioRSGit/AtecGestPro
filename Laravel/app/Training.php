<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    public function users()
    {
        return $this->hasMany(PartnerTrainingUser::class);
    }
}
