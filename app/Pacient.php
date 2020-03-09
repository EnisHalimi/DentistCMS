<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Pacient extends Model
{

    protected $dates = ['created_at', 'date_of_birth'];

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

    public function getDateOfBirthAttribute($value)
    {
        return date('d/m/Y',strtotime($value));
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y H:m',strtotime($value));
    }

    public function getBirthDayAttribute()
    {
        return Carbon::createFromFormat('d/m/Y', $this->date_of_birth)->format('Y-m-d');
    }
}
