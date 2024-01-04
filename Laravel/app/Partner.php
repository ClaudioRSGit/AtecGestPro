<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Partner_Training_User;
use App\Partner_contact;

class Partner extends Model
{
    protected $fillable = [
        'name',
        'description',
        'address',
    ];

    use SoftDeletes;

    public function partnerTrainingUser()
    {
        return $this->hasMany(Partner_Training_User::class);
    }

    public function partnerContacts()
    {
        return $this->hasMany(Partner_contact::class);
    }
}
