<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Partner_Trainings_Users;
use App\Partner_contact;

class Partner extends Model
{
    protected $fillable = [
        'name',
        'description',
        'address',
    ];

    use SoftDeletes;

    public function partnerTrainingsUsers()
    {
        return $this->hasMany(Partner_Trainings_Users::class);
    }

    public function partnerContacts()
    {
        return $this->hasMany(Partner_contact::class);
    }
}
