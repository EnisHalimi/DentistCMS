<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    public function treatments()
    {
        return $this->belongsToMany('App\Treatment','services_treatment');
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y H:m',strtotime($value));
    }
}
