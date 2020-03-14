<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Report;
use App\Pacient;
use App\Treatment;
use Carbon\Carbon;

class Report extends Model
{

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function pacient()
    {
        return $this->belongsTo('App\Pacient');
    }
    

    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y H:m',strtotime($value));
    }

     
    public function getCreatedAttribute()
    {
        return Carbon::createFromFormat('d/m/Y H:m', $this->created_at)->format('d/m/Y');
    }
}
