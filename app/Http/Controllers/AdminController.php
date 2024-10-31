<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;
use App\Notifications\VendorAprrovedNotification;
use Illuminate\Support\Facades\Notification;

class AdminController extends Controller
{
    public function AdminDashboard() // szerkesztés, hozzáadás.
    {
        
        session()->put('user_status', 'belepve');
        return view('admin.index'); // szerkesztés, hozzáadás.
    }
    
    public function AdminLogin(){
       
        return view('admin.admin_login'); // szerkesztés, hozzáadás. az admin mappában az admin_login.blade.php

    }



    public function AdminDestroy(Request $request) //: RedirectResponse
    {
        
        session()->forget('user_status');
        Auth::guard('web')->logout();
        
        $request->session()->invalidate();

        $request->session()->regenerateToken();
     
        return redirect('/admin/login');
    }

    public function AdminProfile(){
        $id = Auth::user()->id; // users table id-ja
        $admindata = User::find($id);
        // a compact segítségével hozzájutunk az összes adathoz a userről, amit pl betölthetünk a profil szerkesztés oldalon az input fieldekben
        return view('admin.admin_profile_view', compact('admindata')); //  admin mappa admin_profile_view.blade.php
    }


    public function AdminProfileStore(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name    = $request->name;
        $data->email   = $request->email;
        $data->phone   = $request->phone;
        $data->address = $request->address;

        if($request->file('photo')){    
            $file     = $request->file('photo');
            @unlink(public_path('upload/admin_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data['photo'] = $filename;
        }

        $data->save();

        // Toast message frissítéskor
        $notification = array(
            'message'    => 'Admin profil sikeresen frissítve',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

    public function AdminChangePassword(){
        return view('admin.admin_change_password');
    }


    public function AdminUpdatePassword(Request $request){
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);
        
        // Régi jelszó ellenőrzése
        if(!Hash::check($request->old_password, Auth::user()->password)){
            return back()->with("error", "A régi jelszó nem stimmel!");
        }

        User::whereId(Auth()->user()->id)->update([

            'password' => Hash::make($request->new_password)
        ]);
        return back()->with("status", "Jelszó sikeresen megváltoztatva!");

    }


    public function InactiveVendor(){
        $inActiveVendor = User::where('status', 'inactive')->where('role', 'vendor')->latest()->get();
        return view('backend.vendor.inactive_vendor', compact('inActiveVendor'));
    }


    public function InactiveVendorDetails($id){
        $inActiveVendorDetails = User::findOrFail($id);
        return view('backend.vendor.inactive_vendor_details', compact('inActiveVendorDetails'));
    }


    public function ActiveVendor(){
        $ActiveVendor = User::where('status', 'active')->where('role', 'vendor')->latest()->get();
        return view('backend.vendor.active_vendor', compact('ActiveVendor'));
    }

    // Admin aktiválja az eladót
    public function ActiveVendorApprove(Request $request){
        $vendor_id = $request->id;
        $user = User::findOrFail($vendor_id)->update([

            'status' => 'active'
        ]);        

        $notification = array(
            'message'    => 'Üzlet sikeresen aktiválva!',
            'alert-type' => 'success'
        );

        // Kiválasztása az épp belépett eladónak, és értesítés az eladónak, ha aktiválják a fiókját
        $vuser = User::where('role', 'vendor')->get();
        // Komment. Értesítés küldése
        Notification::send($vuser, new VendorAprrovedNotification($request));

        return redirect()->route('active.vendor')->with($notification);  
    }


    public function ActiveVendorDetails($id){
        $ActiveVendorDetails = User::findOrFail($id);
        return view('backend.vendor.active_vendor_details', compact('ActiveVendorDetails'));
    }




        // Admin inaktiválja az eladót
        public function InActiveVendorApprove(Request $request){
            $vendor_id = $request->id;
            $user = User::findOrFail($vendor_id)->update([
    
                'status' => 'inactive'
            ]);        
    
            $notification = array(
                'message'    => 'Üzlet sikeresen inaktiválva!',
                'alert-type' => 'success'
            );
    
            return redirect()->route('inactive.vendor')->with($notification);  
        }



        public function AllAdmin(){

            $allAdminUser = User::where('role', 'admin')->latest()->get();

            return view('backend.admin.all_admin', compact('allAdminUser'));

        }


        public function AddAdmin(){

            $roles = Role::all();

            return view('backend.admin.add_admin', compact('roles'));

        }



        // Komment. Admin hozzáadása
        public function AdminUserStore(Request $request){

            $user            = new User();
            $user->name      = $request->name;
            $user->username  = $request->username;
            $user->email     = $request->email;
            $user->password  = Hash::make($request->password);
            $user->phone     = $request->phone;
            $user->address   = $request->address;
            $user->role      = 'admin';
            $user->status    = 'active';
            $user->save();
      
        if ($request->roles) {
            
            $user->assignRole($request->roles);
        }

           $notification = array(
                'message'    => 'Admin sikeresen létrehozva!',
                'alert-type' => 'success'
            );
    
            return redirect()->route('all.admin')->with($notification);  

        }


        public function EditAdminRole($id){

            $user = User::findOrFail($id);
            $roles = Role::all();

            #dd($user);
            return view('backend.admin.edit_admin', compact('user', 'roles'));

        }       


     
        public function AdminUserUpdate(Request $request, $id){

            $user            = User::findOrFail($id);
            $user->name      = $request->name;
            $user->username  = $request->username;
            $user->email     = $request->email;         
            $user->phone     = $request->phone;
            $user->address   = $request->address;
            $user->role      = 'admin';
            $user->status    = 'active';
            $user->save();
            
            $user->roles()->detach();

        if ($request->roles) {
            
            $user->assignRole($request->roles);
        }

           $notification = array(
                'message'    => 'Admin sikeresen szerkesztve!',
                'alert-type' => 'success'
            );
    
            return redirect()->route('all.admin')->with($notification); 
      

        }


        // Admin vagy user vagy ceo törlése
        public function DeleteAdminRole($id){

            $user = User::findOrFail($id);
            if (!is_null($user)) {
                $user->delete();
            }
            $notification = array(
                'message'    => 'Sikeresen törölve!',
                'alert-type' => 'success'
            );
    
            return redirect()->route('all.admin')->with($notification); 
        }
}
