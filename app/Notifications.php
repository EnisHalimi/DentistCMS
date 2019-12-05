<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
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
}
