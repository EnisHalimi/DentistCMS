<?php

namespace App;

use Illuminate\Database\Eloquent\Model; 
use Carbon\Carbon;

class Payment extends Model
{
    public function services()
    {
        return $this->belongsToMany('App\Services','payments_services')->withPivot('tooth', 'discount','quantity');
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y H:m:s',strtotime($value));
    }

    public function getCreatedAttribute()
    {
        return Carbon::createFromFormat('d/m/Y H:m:s', $this->created_at)->format('d/m/Y');
    }
}
