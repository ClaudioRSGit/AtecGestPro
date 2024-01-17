<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaterialUser extends Model
{
    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
