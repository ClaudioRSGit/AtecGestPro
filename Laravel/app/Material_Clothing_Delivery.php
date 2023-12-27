<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Material;
use App\Clothing_Delivery;

class Material_Clothing_Delivery extends Model
{
    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function Clothing_Delivery()
    {
        return $this->belongsTo(Clothing_Delivery::class);
    }
}
