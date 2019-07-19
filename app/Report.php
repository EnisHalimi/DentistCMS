<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    public function treatment()
    {
        return $this->belongsTo('App\Treatment');
    }
}
