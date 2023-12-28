<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Material;
use App\Clothing_Delivery;

class Material_Clothing_Delivery extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'material_id', 'clothing_delivery_id'
    ];

    //02.02
    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function Clothing_Delivery()
    {
        return $this->belongsTo(Clothing_Delivery::class);
    }
}
