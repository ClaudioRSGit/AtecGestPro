<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaterialPartnerTrainingUser extends Model
{
    protected $fillable = [
        'material_id', 'partner_training_user_id', 'quantity'
    ];
    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function partnerTrainingUser()
    {
        return $this->belongsTo(PartnerTrainingUser::class);
    }
}
