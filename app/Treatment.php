<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Pacient;
use App\Treatment;
use Carbon\Carbon;

class Treatment extends Model
{

    protected $dates = ['created_at', 'starting_date'];

    public function pacient()
    {
        return $this->belongsTo('App\Pacient');
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

    public function getStartingDateAttribute($value)
    {
        return date('d/m/Y',strtotime($value));
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y H:m',strtotime($value));
    }

    public function getDateStartingAttribute()
    {
        return Carbon::createFromFormat('d/m/Y', $this->starting_date)->format('Y-m-d');
    }
}
