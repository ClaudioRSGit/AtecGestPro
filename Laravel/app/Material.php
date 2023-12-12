<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Material_Training;
use App\Material_Clothing_Delivery;

class Material extends Model
{
    use SoftDeletes;

    public function Material_Training()
    {
        return $this->hasMany(\App\Material_Training::class);
    }

    public function Material_Clothing_Delivery()
    {
        return $this->hasMany(\App\Material_Clothing_Delivery::class);
    }
}
