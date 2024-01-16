<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use softDeletes;

    //all fillable fields
    protected $guarded = [

    ];
    public function actions()
    {
        return $this->hasMany(Action::class);
    }

    public function courseClass()
    {
        return $this->belongsTo(CourseClass::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function material()
    {
        return $this->belongsToMany(Material::class, 'material_user', 'user_id', 'material_id')->withPivot('quantity', 'size_id', 'delivery_date', 'delivery_address', 'delivery_city', 'delivery_zip_code', 'delivery_country', 'delivery_contact', 'delivery_phone', 'delivery_email', 'delivery_date', 'delivery_address', 'delivery_city', 'delivery_zip_code', 'delivery_country', 'delivery_contact', 'delivery_phone', 'delivery_email', 'delivery_date', 'delivery_address', 'delivery_city', 'delivery_zip_code', 'delivery_country', 'delivery_contact', 'delivery_phone', 'delivery_email', 'delivery_date', 'delivery_address', 'delivery_city', 'delivery_zip_code', 'delivery_country', 'delivery_contact', 'delivery_phone', 'delivery_email', 'delivery_date', 'delivery_address', 'delivery_city', 'delivery_zip_code', 'delivery_country', 'delivery_contact', 'delivery_phone', 'delivery_all');
    }

}
