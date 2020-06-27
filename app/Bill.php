<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Bill extends Model
{
    use LogsActivity;

    protected static $logAttributes = ['subject', 'bill_nr','deadline','value','created_at'];

}
