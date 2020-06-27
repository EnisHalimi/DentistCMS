<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Visit extends Model
{
    use LogsActivity;

    protected static $logAttributes = ['time_of_visit', 'date_of_visit','pacient.first_name','pacient.last_name', 'pacient.personal_number','user.name'];

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
