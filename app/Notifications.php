<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    public static function getNotificationsNumber()
    {
        $notifications = Notifications::where('opened', false)->count();
        return $notifications;
    }

    public static function getNotifications()
    {
        $notifications = Notifications::where('opened', false)->get();
        return $notifications;
    }
}
