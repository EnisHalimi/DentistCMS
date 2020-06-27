<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Pacient;
use App\Treatment;
use Spatie\Activitylog\Traits\LogsActivity;

class Treatment extends Model
{

    use LogsActivity;

    protected static $logAttributes = ['pacient.first_name','pacient.last_name', 'pacient.personal_number','starting_date','duration','created_at'];

    public function pacient()
    {
        return $this->belongsTo('App\Pacient');
    }


    public function services()
    {
        return $this->belongsToMany('App\Services','services_treatment');
    }

    public static function getTreatment($id)
    {
        $treatment = Treatment::find($id);
        $pacient = Pacient::find($treatment->pacient_id);
        return $pacient->first_name.' '.$pacient->last_name.' ('.$treatment->starting_date.' | '.$treatment->duration.')';
    }

}
