<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Services;
use Spatie\Activitylog\Traits\LogsActivity;

class Services extends Model
{

    use LogsActivity;

    protected static $logAttributes = ['name','price','discount','created_at'];

    public function treatments()
    {
        return $this->belongsToMany('App\Treatment','services_treatment');
    }

    public function payments()
    {
        return $this->belongsToMany('App\Payment','payments_services')->withPivot('tooth', 'discount','quantity');
    }

    public static function getName($id)
    {
        $service = Services::find($id);
        return $service->name;
    }

}
