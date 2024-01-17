<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaterialSize extends Model
{
    use softDeletes;

    protected $fillable = ['material_id', 'size_id', 'quantity'];
    protected $casts = [
        'material_id' => 'integer',
        'size_id' => 'integer',
        'quantity' => 'integer',
    ];


    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }


}
