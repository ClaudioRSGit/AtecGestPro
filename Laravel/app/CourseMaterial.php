<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseMaterial extends Model
{
    //make all fillable
    protected $guarded = [];
    use softDeletes;
    public function courses()
    {
        return $this->belongsTo(Course::class);
    }

    public function materials()
    {
        return $this->belongsTo(Material::class);
    }
}
