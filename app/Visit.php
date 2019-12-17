<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Visit extends Model
{   
    protected $dates = ['created_at', 'date_of_visit'];

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

    public function getDateOfVisitAttribute($value)
    {
        return date('d/m/Y',strtotime($value));
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y H:m',strtotime($value));
    }

    public function getVisitDateAttribute()
    {
        return Carbon::createFromFormat('d/m/Y', $this->date_of_visit)->format('Y-m-d');
    }
}
