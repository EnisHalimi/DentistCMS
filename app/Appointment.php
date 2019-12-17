<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Appointment extends Model
{

    protected $dates = ['created_at', 'date_of_appointment'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function pacient()
    {
        return $this->belongsTo('App\Pacient');
    }

    public static function getAppointmentByTimeAndDate($time, $date)
    {
        $newdate = date('Y-m-d',strtotime($date));
        $appointment = Appointment::where([
            ['time_of_appointment', '=', $time],
            ['date_of_appointment', '=', $newdate],
        ])->first();
        if($appointment == null)
            return "-";
        return Pacient::getPacientName($appointment->pacient_id);
    }

    public static function getAppointmentNumberToday($date)
    {   
        $appointment = Appointment::where('date_of_appointment', '=', $date)->get();
        return count($appointment);
    }

    public function getDateOfAppointmentAttribute($value)
    {
        return date('d/m/Y',strtotime($value));
    }

    public function getAppointmentDateAttribute()
    {
        return Carbon::createFromFormat('d/m/Y', $this->date_of_appointment)->format('Y-m-d');
    }
}
