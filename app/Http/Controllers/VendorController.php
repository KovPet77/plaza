<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Notifications\VendorRegNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisztracioMegerosites;


class VendorController extends Controller
{
    public function VendorDashboard() // szerkesztés, hozzáadás.
    {
        return view('vendor.index'); // szerkesztés, hozzáadás.
    }


    public function VendorLogin()
    {
        return view('vendor.vendor_login'); //  az vendor mappában az vendor_login.blade.php

    }

    public function VendorDestroy(Request $request) //: RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/vendor/login');
    }

    public function VendorProfile()
    {
        $id = Auth::user()->id; // users table id-ja
        $vendordata = User::find($id);
        // a compact segítségével hozzájutunk az összes adathoz a userről, amit pl betölthetünk a profil szerkesztés oldalon az input fieldekben
        return view('vendor.vendor_profile_view', compact('vendordata')); //  vendor mappa vendor_profile_view.blade.php
    }


    public function VendorChangePassword()
    {
        return view('vendor.vendor_change_password');
    }


    public function VendorUpdatePassword(Request $request)
    {
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

    public function VendorProfileStore(Request $request) // szerkesztés, hozzáadás.

    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name              = $request->name;
        $data->email             = $request->email;
        $data->phone             = $request->phone;
        $data->address           = $request->address;
        $data->vendor_join       = $request->vendor_join;
        $data->vendor_short_info = $request->vendor_short_info;

        if($request->file('photo')){    
            $file     = $request->file('photo');
            @unlink(public_path('upload/vendor_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/vendor_images'), $filename);
            $data['photo'] = $filename;
        }

        $data->save();

        // Toast message frissítéskor
        $notification = array(
            'message'    => 'Üzlet profil sikeresen frissítve',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }


    public function BecomeVendor()
    {
        return view('auth/become_vendor');
    }




public function VendorRegisztracioMasodikLepes(Request $request) {
    // Véletlen 4 számjegyű kód generálása és munkamenetben tárolása
    $verificationCode = rand(1000, 9999);
    Session::put('verification_code', $verificationCode);
    Session::put('name', $request->name);
    Session::put('username', $request->username);
    Session::put('email', $request->email);
    Session::put('phone', $request->phone);
    Session::put('vendor_join', $request->vendor_join);
    Session::put('adatkezeles', $request->adatkezeles);
    Session::put('password', Hash::make($request->password));
    Session::put('vendor_slug', strtolower(str_replace(' ', '-', $request->name)));
    // Munkamenet tartalmának ellenőrzése
    $sessionData = Session::all();
    #dd($sessionData);

    if (Session::get('adatkezeles') === null) {
        return view('frontend/users/invalid_adatok');
    }

    /* Email küldése */
    $mail = new RegisztracioMegerosites($verificationCode);

    // Megfelelően az Session::get() függvényt használd az email cím lekérdezéséhez a munkamenetből
    $email = Session::get('email');

    // Levél küldése
    Mail::to($email)->send($mail);

    return view('frontend.users.VendorRegisztracioMasodikLepes');
}





    public function VendorRegisztracioHarmadiklepes(Request $request){


        //Komment. Az admin kiválasztása, mert őt fogja értesíteni az új eladó regisztrációjakor
        $vuser = User::where('role', 'admin')->get();



/*

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed'], // a 'confirmed' után ez volt: Rules\Password::defaults() De ki kellett törölni mert hibát dob
        ]);


        $user = User::insert([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'vendor_join' => $request->vendor_join,
            'password' => Hash::make($request->password),
            'role' => 'vendor',
            'status' => 'inactive',
        ]);

        $notification = array(
            'message'    => 'Üzlet profil sikeresen létrehozva',
            'alert-type' => 'success'
        );


*/


    // A post requestből kinyert confirmation_code
    $confirmationCode = $request->confirmation_code;

    // A Session-ből kinyert verification_code
    $verificationCode = Session::get('verification_code');

    // Ellenőrizd, hogy a két kód egyezik-e
    if ($confirmationCode == $verificationCode) {
        // A kódok egyeznek, hozz létre egy új felhasználót az adatbázisban
        $user = new User();

       $user = User::insert([
            'name' => Session::get('name'),
            'username' =>  Session::get('username'),
            'email' => Session::get('email'),
            'phone' => Session::get('phone'),
            'vendor_join' =>  Session::get('vendor_join'),
            'password' => Session::get('password'),
            'vendor_slug' => Session::get('vendor_slug'),
            'role' => 'vendor',
            'status' => 'inactive',
        ]);



        // Most már törölheted a munkamenetből a Session-ben tárolt adatokat, mivel a regisztráció megtörtént
        Session::forget(['verification_code', 'name', 'username', 'email', 'password', 'vendor_slug']);

        // Komment. Értesítés küldése az adminnak az új eladóról
        Notification::send($vuser, new VendorRegNotification($request));
        return redirect('vendor/login');

        // Visszatérés a siker oldalra vagy az alkalmazás következő lépésére
        return view('frontend.users.RegisztracioSiker');

    }else {
        // A kódok nem egyeznek, visszatérés hibaüzenettel vagy a regisztrációs oldalra     
        return  view('/frontend.users.RegisztracioSikertelen');
    }
    }
}
