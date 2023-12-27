<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Partner;

class Partner_contact extends Model
{

    protected $fillable = [
        'contact',
        'description',
        'partner_id',
    ];

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }
}
