<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Material_Training;
use App\Partner_Trainings_Users;

class Training extends Model
{
    protected $fillable = [
        'name',
        'description',
        'category'
    ];

    use SoftDeletes;

    public function Material_Training()
    {
        return $this->hasMany(Material_Training::class);
    }

    public function Partner_Trainings_Users()
    {
        return $this->hasMany(Partner_Trainings_Users::class);
    }



}
