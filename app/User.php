<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function visit()
    {
        return $this->hasMany('App\Visit');
    }

    public function appointment()
    {
        return $this->hasMany('App\Appointment');
    }


    public function report()
    {
        return $this->hasMany('App\Report');
    }

    public static function getUser($id)
    {
        $user = User::find($id);
        return $user->name;
    }

    public static function getLogo()
    {
        $settings = DB::table('settings')->first();
        if(empty($settings))
            return 'http://maestroselectronics.com/wp-content/uploads/2017/12/No_Image_Available.jpg';
        if(substr($settings->logo, 0, 4 ) === "http")	
			return $settings->logo;
        return asset('img/'.$settings->logo.'');
    }

    public static function getAppName()
    {
        $settings = DB::table('settings')->first();
        if(empty($settings))
        return 'DentistCMS';
        return $settings->app_name;
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y H:m',strtotime($value));
    }

}
