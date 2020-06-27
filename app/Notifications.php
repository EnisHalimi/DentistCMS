<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Spatie\Activitylog\Traits\LogsActivity;

class Notifications extends Model
{
    use LogsActivity;

    protected static $logAttributes = ['description', 'date','type'];

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
