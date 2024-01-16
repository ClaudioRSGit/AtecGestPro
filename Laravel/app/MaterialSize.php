<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaterialSize extends Model
{
    use softDeletes;
    protected $fillable = ['material_id', 'size_id', 'stock'];
    protected $table = 'material_users';
    use softDeletes;
    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }


}
