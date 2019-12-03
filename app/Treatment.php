<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    public function visit()
    {
        return $this->belongsTo('App\Visit');
    }

    public function report()
    {
        return $this->hasOne('App\Report');
    }

    public function services()
    {
        return $this->belongsToMany('App\Services');
    }
}
