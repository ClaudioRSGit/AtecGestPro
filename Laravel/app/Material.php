<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Material_Training;
use App\Material_Clothing_Delivery;
use App\Clothing_Delivery;
use ShiftOneLabs\LaravelCascadeDeletes\CascadesDeletes;



class Material extends Model
{
    use CascadesDeletes;

    protected $cascadeDeletes = ['material__trainings'];

    protected $fillable = [
        'name',
        'description',
        'isInternal',
        'quantity',
        'aquisition_date',
        'supplier',
        'isClothing',
        'gender',
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
