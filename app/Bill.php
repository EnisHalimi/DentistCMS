<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    
    public function getDeadlineAttribute($value)
    {
        return date('d/m/Y',strtotime($value));
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y H:m:s',strtotime($value));
    }

    public function getDeadlineDateAttribute()
    {
        return Carbon::createFromFormat('d/m/Y', $this->deadline)->format('Y-m-d');
    }
}
