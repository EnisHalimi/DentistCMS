<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Appointment extends Model
{
    use LogsActivity;

    protected static $logAttributes = ['time_of_appointment', 'date_of_appointment','pacient.first_name','pacient.last_name', 'pacient.personal_number','user.name'];

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
}
