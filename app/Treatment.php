<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Pacient;
use App\Treatment;

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

    public static function getTreatment($id)
    {
        $treatment = Treatment::find($id);
        $pacient = Pacient::find($treatment->pacient_id);
        return $pacient->first_name.' '.$pacient->last_name.' ('.$treatment->starting_date.' | '.$treatment->duration.')';
    }

    public static function getStartingDate($id)
    {
        $treatment = Treatment::find($id);
        return $treatment->starting_date;
    }
}
