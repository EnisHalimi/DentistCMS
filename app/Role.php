<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Permission;
use DB;
use Carbon\Carbon;
use Spatie\Activitylog\Traits\LogsActivity;

class Role extends Model
{

    use LogsActivity;

    protected static $logAttributes = ['slug','name','created_at'];

    public function permissions() {
        return $this->belongsToMany('App\Permission','roles_permissions');
    }

    public function users() {
        return $this->hasMany('App\User');
    }

    public static function getRole($id)
    {
        $role = Role::find($id);
        return $role->name;
    }

    public static function hasPermission($id, $perm)
    {
        $role = Role::find($id)->permissions()->where('slug','LIKE',$perm)->count();
        if($role == 0)
            return false;
        else
            return true;

    }

    public static function hasAccess($id, $perm)
    {
        $role = Role::find($id)->permissions()->where('name','LIKE',$perm.'%')->count();
        $permission = Permission::where('name','LIKE',$perm.'%')->count();
        if($role == 0)
            return -1;
        else if($role == $permission)
            return 1;
        else
            return 0;

    }
}
