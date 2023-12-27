<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Training;
use App\Material;

class Material_Training extends Model
{
    protected $fillable = [
        'quantity',
    ];

    public function training()
    {
        return $this->belongsTo(Training::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
