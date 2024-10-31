<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisztracioMegerosites;


class UserController extends Controller
{
    





    public function Regisztracio(){


        return view('auth/regisztracio');
    }







public function RegisztracioMasodikLepes(Request $request) {
    
    
    #return view('frontend.users.InactiveWebsite');
    
    
    
    // Véletlen 4 számjegyű kód generálása és munkamenetben tárolása
    $verificationCode = rand(1000, 9999);
    Session::put('verification_code', $verificationCode);
    Session::put('name', $request->name);
    Session::put('username', $request->username);
    Session::put('email', $request->email);
    Session::put('adatkezeles', $request->adatkezeles);
    Session::put('password', Hash::make($request->password));

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

    return view('frontend.users.RegisztracioMasodikLepes');
}






 public function RegisztracioHarmadiklepes(Request $request){


    // A post requestből kinyert confirmation_code
    $confirmationCode = $request->confirmation_code;

    // A Session-ből kinyert verification_code
    $verificationCode = Session::get('verification_code');

    // Ellenőrizd, hogy a két kód egyezik-e
    if ($confirmationCode == $verificationCode) {
        // A kódok egyeznek, hozz létre egy új felhasználót az adatbázisban
        $user = new User();
        $user->name = Session::get('name');
        $user->username = Session::get('username');
        $user->email = Session::get('email');
        $user->password = Session::get('password');
        
        $user->save();

        // Most már törölheted a munkamenetből a Session-ben tárolt adatokat, mivel a regisztráció megtörtént
        Session::forget(['verification_code', 'name', 'username', 'email', 'password']);

        // Visszatérés a siker oldalra vagy az alkalmazás következő lépésére
        return view('frontend.users.RegisztracioSiker');
        
    } else {
        // A kódok nem egyeznek, visszatérés hibaüzenettel vagy a regisztrációs oldalra

     
        return  view('/frontend.users.RegisztracioSikertelen');
    }
}





    public function UserDashboard()
    {
        $id = Auth::user()->id; // users table id-ja
        $userData = User::find($id);

        return view('index', compact('userData')); // userData adatok átpasszolása az index oldalnak
    }






    public function UserProfileStore(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name    = $request->name;
        $data->username    = $request->username;
        $data->email   = $request->email;
        $data->phone   = $request->phone;
        $data->address = $request->address;

        if($request->file('photo')){    
            $file     = $request->file('photo');
            @unlink(public_path('upload/user_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'), $filename);
            $data['photo'] = $filename;
        }

        $data->save();

        // Toast message frissítéskor
        $notification = array(
            'message'    => 'Felhasználó profil sikeresen frissítve',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }


    public function UserLogout(Request $request) //: RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message'    => 'Sikeres kijelentkezés',
            'alert-type' => 'success'
        );  

        return redirect('/login')->with($notification);
    }

    public function UserUpdatePassword(Request $request)
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
}
