<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Partner;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partner_contact extends Model
{
    protected $fillable = [
        'contact',
        'description',
    ];

    use SoftDeletes;

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }
}
