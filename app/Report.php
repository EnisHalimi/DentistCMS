<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Report;
use App\Pacient;
use App\Treatment;
use Spatie\Activitylog\Traits\LogsActivity;

class Report extends Model
{
    use LogsActivity;

    protected static $logAttributes = ['user.name', 'pacient.first_name','pacient.last_name', 'pacient.personal_number','recommendation','complaint','evaluation','diagnosis','created_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function pacient()
    {
        return $this->belongsTo('App\Pacient');
    }

}
