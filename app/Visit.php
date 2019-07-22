<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    
    public function treatment()
    {
        return $this->hasOne('App\Treatment');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function pacient()
    {
        return $this->belongsTo('App\Pacient');
    }
}
