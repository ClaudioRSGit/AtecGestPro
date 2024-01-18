<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Material extends Model
{
    //
    use softDeletes;
    protected $fillable = ['name', 'description', 'isInternal', 'quantity', 'acquisition_date', 'supplier', 'isClothing', 'gender'];

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'material_sizes')->withPivot('stock');
    }


    public function users()
    {
        return $this->belongsToMany('App\User', 'material_users', 'material_id', 'user_id')->withPivot('quantity', 'delivery_date', 'delivered_all', 'size_id');
    }

    public function partnerTrainingUsers()
    {
        return $this->belongsToMany(PartnerTrainingUser::class, 'material_partner_training_users')->withPivot('quantity');
    }



    public function courses()
    {
        return $this->belongsToMany('App\Course', 'course_materials', 'material_id', 'course_id');
    }


}
