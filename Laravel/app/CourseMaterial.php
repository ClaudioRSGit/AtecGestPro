<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseMaterial extends Model
{
    //
    public function courses()
    {
        return $this->belongsTo(Course::class);
    }

    public function materials()
    {
        return $this->belongsTo(Material::class);
    }
}
