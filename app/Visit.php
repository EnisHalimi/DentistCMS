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

    public static function getVisitPacientName($id)
    {
        $visit = Visit::find($id);
        $pacient = Pacient::find($visit->pacient_id);
        return $pacient->first_name. ' '.$pacient->last_name;
    }
}
