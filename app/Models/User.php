<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Traits\HasRoles;
use DB;

 
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */


    protected $guarded = []; // szerkesztés, hozzáadás







    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // Figyelem. A UserOnline funkció a user_all_data.blade.php-ban van használva
    public function UserOnline(){

        return Cache::has('user-is-online' . $this->id);
    }


    public static function getPermissionGroups(){

        // Figyelem. DB query használata model segítségével:
        // A return értékét a RoleController AddRolesPermission nevű funkciója használja majd fel.
        $permission_group = DB::table('permissions')->select('group_name')->groupBy('group_name')->get();
        return $permission_group;
    }

    public static function getPermissionByGroupName($group_name){
        // Figyelem. where-> ahol az adatbázisban lévő group_name egyezik a kérésben szereplő $group_name-el...
        $permissions = DB::table('permissions')->select('name', 'id')->where('group_name', $group_name)->get();

        return $permissions;
    }




/*
 Komment. A role_permission edit.ben van felhasználva ez a funkció. Itt: <label class="form-check-label" for="flexCheckDefault" {{ App\Models\User::roleHasPermissions($role, $permissions) ? 'checked' : ''}} >{{ $group->group_name }}</label>
*/
    public static function roleHasPermissions($role, $permissions) {

        $hasPermission = true;
        foreach($permissions as $permission){

            if (!$role->hasPermissionTo($permission->name)) {
                $hasPermission = false;
                return $hasPermission;
            }

                return $hasPermission;

        }
    }
}   
