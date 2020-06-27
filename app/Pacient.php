<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;


class Pacient extends Model
{
    use LogsActivity;

    protected static $logAttributes = ['first_name', 'fathers_name','last_name','personal_number', 'gender','date_of_birth','address','residence', 'city','phone','email'];


    public function visit()
    {
        return $this->hasMany('App\Visit');
    }

    public function treatment()
    {
        return $this->hasMany('App\Treatment');
    }

    public function appointment()
    {
        return $this->hasMany('App\Appointment');
    }

    public function report()
    {
        return $this->hasMany('App\Report');
    }

    public function payment()
    {
        return $this->hasMany('App\Payment');
    }

    public function debt()
    {
        return $this->hasMany('App\Debt');
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

    public static function getPacientID($id)
    {
        $pacient = Pacient::find($id);
        return ''.$pacient->personal_number;
    }
}
