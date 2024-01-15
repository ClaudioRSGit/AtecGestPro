<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaterialSize extends Model
{
    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }


}
