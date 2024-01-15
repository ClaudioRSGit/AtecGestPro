<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaterialPartnerTrainingUser extends Model
{
    use softDeletes;
    protected $fillable = [
        'material_id', 'partner_training_user_id', 'quantity'
    ];
    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
