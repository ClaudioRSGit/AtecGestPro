<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Training;
use App\Material;

class Material_Training extends Model
{
    protected $fillable = [
        'partner__training__users_id',
        'material_id',
        'quantity',
    ];

    public function partnerTrainingUser()
    {
        return $this->belongsTo(Partner_Training_User::class, 'partner__training__users_id');
    }


    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
