<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Material_Clothing_Delivery;

class Clothing_Delivery extends Model
{
    protected $fillable = [
        'user_id', 'material_id', 'delivery_date', 'delivery_status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function Material_Clothing_Delivery()
    {
        return $this->hasMany(\App\Material_Clothing_Delivery::class);
    }
}
