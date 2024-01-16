<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PartnerTrainingUser extends Model
{
    use softDeletes;

    protected $fillable = ['partner_id', 'training_id', 'user_id', 'start_date', 'end_date', ];

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    public function training()
    {
        return $this->belongsTo(Training::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function materials()
    {
        return $this->belongsToMany('App\Material', 'material_partner_training_users', 'partner_training_user_id', 'material_id')->withPivot('stock');
    }
}
