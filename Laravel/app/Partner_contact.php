<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Partner;

class Partner_contact extends Model
{
    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }
}
