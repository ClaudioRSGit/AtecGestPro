<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'material_sizes')->withPivot('stock');
    }



}
