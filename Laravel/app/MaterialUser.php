<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaterialUser extends Model
{
    protected $fillable = [
        'material_id',
        'user_id',
        'quantity',
        'size_id',
        'delivery_date',
        'delivered_all',
    ];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
