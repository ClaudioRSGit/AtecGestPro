<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Size extends Model
{
    protected $fillable = ['size'];

    use softDeletes;

public function materials()
    {
        return $this->belongsToMany(Material::class, 'material_sizes', 'size_id', 'material_id')->withPivot('stock');
    }

    public function material_users()
    {
        return $this->hasMany(MaterialUser::class);
    }
}
