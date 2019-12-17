<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{

    protected $dates = ['created_at', 'date'];

    public static function getNotificationsNumber()
    {
        $notifications = Notifications::where('date','=',date('Y-m-d',strtotime('tomorrow')))->
        where('opened','=',false)
        ->count();
        return $notifications;
    }

    public static function getNotifications()
    {
        $notifications = Notifications::where('date','=',date('Y-m-d',strtotime('tomorrow')))->
        where('opened','=',false)->get();
        return $notifications;
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y H:m:s',strtotime($value));
    }

    
}
