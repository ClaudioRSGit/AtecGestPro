<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactPartner extends Model
{
    protected $guarded = [];
    use softDeletes;
    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }
}
