<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Training extends Model
{
    use softDeletes;

    protected $guarded = [];

    public function partnerTrainingUsers()
    {
        return $this->hasMany(PartnerTrainingUser::class);
    }
}
