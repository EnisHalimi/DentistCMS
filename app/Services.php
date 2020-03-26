<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Services;

class Services extends Model
{
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

    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y H:m',strtotime($value));
    }
}
