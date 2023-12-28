<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Training;
use App\Material;

class Material_Training extends Model
{
    protected $fillable = [
        'quantity',
    ];

    public function partnerTrainingUser()
    {
        return $this->belongsTo(Partner_Trainings_Users::class, 'partner__trainings__user_id');
    }


    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
