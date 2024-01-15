<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    public function partnerTrainingUsers()
    {
        return $this->hasMany(PartnerTrainingUser::class);
    }

    public function contactPartner()
    {
        return $this->hasMany(ContactPartner::class);
    }
}
