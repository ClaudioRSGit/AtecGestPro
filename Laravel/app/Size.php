<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    // ... other attributes and methods

    public function materials()
    {
        return $this->belongsToMany(Material::class, 'material_sizes')->withPivot('stock');
    }
}
// Compare this snippet from resources/views/materials/show.blade.php:
// @extends('layouts.app')
//
