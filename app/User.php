<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use App\Role;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{

    use LogsActivity;

    protected static $logAttributes = ['name','email', 'role.name','color','created_at'];


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
        $company = DB::table('company')->first();
        if(empty($company))
            return 'http://maestroselectronics.com/wp-content/uploads/2017/12/No_Image_Available.jpg';
        if(substr($company->logo, 0, 4 ) === "http")
			return $company->logo;
        return asset('img/'.$company->logo.'');
    }

    public static function getAppName()
    {
        $company = DB::table('company')->first();
        if(empty($company))
            return 'DentistCMS';
        return $company->name;
    }

    public static function getAppTheme()
    {
        $company = DB::table('company')->first();
        if(empty($company))
        {
            return false;
        }
        else
            return $company->theme;
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
