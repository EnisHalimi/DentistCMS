<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Pacient extends Model
{
    public function visit()
    {
        return $this->hasMany('App\Visit');
    }

    public function appointment()
    {
        return $this->hasMany('App\Appointment');
    }


    public function contact()
    {
        return $this->hasOne('App\Contact');
    }

    public static function getPacient($id)
    {
        $pacient = Pacient::find($id);
        return $pacient->first_name. ' '.$pacient->last_name. ' '.$pacient->personal_number ;
    }

    public static function getPacientName($id)
    {
        $pacient = Pacient::find($id);
        return $pacient->first_name. ' '.$pacient->last_name;
    }
}
