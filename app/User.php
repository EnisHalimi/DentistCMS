<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use App\Role;

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


    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public static function getUser($id)
    {
        $user = User::find($id);
        return $user->name;
    }

    public static function getUserColor($id)
    {
        $user = User::find($id);
        return $user->color;
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

    public static function getAppTheme()
    {
        $settings = DB::table('settings')->first();
        if(empty($settings))
        {
            return false;
        }
        else
            return $settings->theme;
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y H:m',strtotime($value));
    }

    public function hasPermission($perm) 
    {
        $role = Role::find($this->role_id);
        foreach ($role->permissions as $permission) {
            if($permission->slug == $perm)
                return true;
        }
        return false;
    }

    public static function getRolesCount($id)
    {
        $role = User::where('role_id','=',$id)->count();
        return $role;
    }




}
