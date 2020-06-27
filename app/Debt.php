<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Debt extends Model
{
    use LogsActivity;

    protected static $logAttributes = ['pacient.first_name','pacient.last_name', 'pacient.personal_number', 'deadline','value','created_at'];

    public function pacient()
    {
        return $this->belongsTo('App\Pacient');
    }
}
