<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    public function visit()
    {
        return $this->belongsTo('App\Visit');
    }
}
