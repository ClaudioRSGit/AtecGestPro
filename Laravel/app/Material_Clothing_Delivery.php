<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Material;

class Material_Clothing_Delivery extends Model
{
    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
