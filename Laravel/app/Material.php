<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Material_Training;
use App\Material_Clothing_Delivery;

class Material extends Model
{
    protected $fillable = [
        'name',
        'description',
        'supplier',
        'aquisition_date',
        'isInternal',
        'isClothing',
        'gender',
        'quantity',
        'size',
        'role',
    ];

    use SoftDeletes;

    public function materialTraining()
    {
        return $this->hasMany(Material_Training::class);
    }

    public function materialClothingDelivery()
    {
        return $this->hasMany(Material_Clothing_Delivery::class);
    }
}
