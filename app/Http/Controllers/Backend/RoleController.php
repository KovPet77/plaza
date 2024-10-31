<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use DB;



class RoleController extends Controller
{
    




    public function AllPermission(){

        $permissions = Permission::all(); // All data megszerzése
        return view('backend.pages.permission.all_permission', compact('permissions'));
    }



    public function AddPermission(){
        return view('backend.pages.permission.add_permission');

    }


    public function StorePermission(Request $request){

        $role = Permission::create([

            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);


        $notification = array(
            'message'    => 'Jogosultság sikeresen hozzáadva!',
            'alert-type' => 'success'
        );
        return redirect()->route('all.permission')->with($notification);
    }



    public function EditPermission($id){

        $permission =  Permission::findOrFail($id);
        return view('backend.pages.permission.edit_permission', compact('permission'));

    }  



      public function UpdatePermission(Request $request){

        $per_id =  $request->id;

        Permission::findOrFail($per_id)->update([

            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);


        $notification = array(
            'message'    => 'Jogosultság sikeresen szerkesztve!',
            'alert-type' => 'success'
        );

        return redirect()->route('all.permission')->with($notification);

    }



    public function DeletePermission($id){

        permission::findOrFail($id)->delete();


        $notification = array(
            'message'    => 'Jogosultság sikeresen törölve!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    public function AllRoles(){

        $roles = Role::all(); // All data megszerzése
        return view('backend.pages.roles.all_roles', compact('roles'));

    }    



    public function AddRoles(){

       
        return view('backend.pages.roles.add_roles');

    }   




     public function StoreRoles(Request $request){

       $role = Role::create([

            'name' => $request->name,
          
        ]);


        $notification = array(
            'message'    => 'Szerep sikeresen hozzáadva!',
            'alert-type' => 'success'
        );
            return redirect()->route('all.roles')->with($notification);

    }

    public function EditRoles($id){

        $roles = Role::findOrFail($id);
        return view('backend.pages.roles.edit_roles', compact('roles'));
    }    



    public function UpdateRoles(Request $request){

        $role_id = $request->id;
        Role::findOrFail($role_id)->update([
            'name' => $request->name,          
        ]);

        $notification = array(
            'message'    => 'Szerep sikeresen szerkesztve!',
            'alert-type' => 'success'
        );
            return redirect()->route('all.roles')->with($notification);

    }


    public function DeleteRoles($id){

        Role::findOrFail($id)->delete();

            $notification = array(
            'message'    => 'Szerep sikeresen törölve!',
            'alert-type' => 'success'
        );
            return redirect()->back()->with($notification);

    }


    public function AddRolesPermission () {

        $roles = Role::all();
        $permission = Permission::all();
        $permission_group = User::getPermissionGroups();
        return view('backend.pages.roles.add_roles_permission', compact('roles','permission', 'permission_group'));
    }


    // Komment. Ez a funkció illeszti adatbázisba a kiválasztott checkbox értékeket a Szerep hozzáadása jogosultsághoz menüpontban
    public function RolePermissionStore(Request $request){

        $data = array();
        $permissions = $request->permission;

        foreach($permissions as $key => $item){

            $data['role_id'] = $request->role_id;
            $data['permission_id'] = $item;

            DB::table('role_has_permissions')->insert($data);
        }

            $notification = array(
            'message'    => 'Szerep jogosultság hozzáadva!',
            'alert-type' => 'success'
        );
            return redirect()->route('all_roles_permission')->with($notification);

    }

    public function AllRolesPermission(){

            $roles = Role::all(); // Összes adat megszerzése
            return view('backend.pages.roles.all_roles_permission', compact('roles'));

    }  


    public function AdminRolesEdit($id){

        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $permission_groups = User::getPermissionGroups();

        return view('backend.pages.roles.role_permission_edit', compact('role', 'permissions', 'permission_groups'));

    }

    public function AdminRolesUpdate(Request $request, $id){

        $role = Role::findOrFail($id);
        $permissions = $request->permission;

        if (!empty($permissions)) {
            
            $role->syncPermissions($permissions);
        }

         $notification = array(
            'message'    => 'Szerep jogosultság sikeresen frissítve!',
            'alert-type' => 'success'
        );
         return redirect()->route('all.roles.permission')->with($notification);

    }


    public function AdminRolesDelete($id){

        $role = Role::findOrFail($id);

        if (!is_null($role)) {

            $role->delete();
        }

         $notification = array(
            'message'    => 'Szerep jogosultság sikeresen törölve!',
            'alert-type' => 'success'
        );
         return redirect()->back()->with($notification);
    }

}
