<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Material_Clothing_Delivery;
use App\Material;
use Illuminate\Database\Eloquent\SoftDeletes;

class Clothing_Delivery extends Model
{

    protected $table = 'clothing_deliveries';

    protected $fillable = [
        'delivered',
        'additionalNotes',
    ];

    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function Material_Clothing_Delivery()
    {
        return $this->hasMany(Material_Clothing_Delivery::class);
    }


}
