<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Advertisers;
use App\Notifications\VendorRegNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisztracioMegerosites;
use Image;
use Carbon\Carbon;





class AdvertiserController extends Controller
{
        


    public function BecomeAdvertiser(){

        return view('auth/become_advertiser');
    }



    public function AdvertiserLogin(){
        return view('advertisers.advertiser_login'); 

    }


    public function AllAdvertiser(){
         // Latest data megszerzése az Advertiser modeltől:
        $categories = Advertisers::latest()->get();
        return view('backend.category.category_all', compact('categories'));
    }

 

public function ReklamazoiRegisztracioMasodikLepes(Request $request) {
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

    return view('frontend.users.ReklamozoiRegisztracioMasodiklepes');
}



    public function ReklamozoiRegisztracioHarmadiklepes(Request $request){

        #dd($request);

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

       $user = Advertisers::insert([
            'name' => Session::get('name'),
            'username' =>  Session::get('username'),
            'email' => Session::get('email'),
            'leiras' => '',
            'phone' => Session::get('phone'),
            'advertiser_join' =>  Session::get('vendor_join'),
            'password' => Session::get('password'),
            'role' => 'advertiser',
            'status' => 'inactive',
        ]);



        // Most már törölheted a munkamenetből a Session-ben tárolt adatokat, mivel a regisztráció megtörtént
        Session::forget(['verification_code', 'name', 'username', 'email', 'password']);

        // Komment. Értesítés küldése az adminnak az új eladóról
        Notification::send($vuser, new VendorRegNotification($request));
        return redirect('advertiser/login');

        // Visszatérés a siker oldalra vagy az alkalmazás következő lépésére
        return view('frontend.users.RegisztracioSiker');

    }else {
        // A kódok nem egyeznek, visszatérés hibaüzenettel vagy a regisztrációs oldalra     
        return  view('/frontend.users.RegisztracioSikertelen');
    }
    }

















    public function AdvertiserRegistration(Request $request){


        //Komment. Az admin kiválasztása, mert őt fogja értesíteni az új eladó regisztrációjakor
        $vuser = User::where('role', 'admin')->get();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed'], // a 'confirmed' után ez volt: Rules\Password::defaults() De ki kellett törölni mert hibát dob
        ]);
        #dd($request);

        $user = Advertisers::insert([
            'name'            => $request->name,
            'username'        => $request->username,
            'email'           => $request->email,
            'phone'           => $request->phone,
            'advertiser_join' => $request->vendor_join,
            'password' => Hash::make($request->password),
            'role'            => 'vendor',
            'status'          => 'inactive',
            'advertiser_type' => 'basic'
        ]);

        $notification = array(
            'message'    => 'Reklámozói profil sikeresen létrehozva',
            'alert-type' => 'success'
        );
        // Komment. Értesítés küldése az adminnak az új eladóról
        Notification::send($vuser, new VendorRegNotification($request));
        return redirect('advertiser/login')->with($notification);
    }
    
    
    
    
    public function OsszesHirdeto(){
        
        #$perPage = 10;
        $advertisers = Advertisers::all();
        #dd($vendors);

        #$advertisers = $advertisers->paginate($perPage);
        
        return view('/advertisers.osszes_hirdetok', compact('advertisers'));
    }
    
    
    public function HirdetoAdatai(Request $request){
        
       
         $id = $request->id;
         $advertiser = Advertisers::where('id', $id)->first();

         
         return view('advertisers.hirdeto_adatlap', compact('advertiser'));
    }
    
    
    public function HirdetoKeresese(Request $request){
        
         #dd($request->search);
         
         $keyword = $request->search;
         $talalat = Advertisers::where('name','LIKE',"%$keyword%")->get();
         #dd($talalat);
         return view('advertisers.hirdeto_talalat', compact('talalat'));
    }
    
    
    
    public function HirdetesHozzadas(){
        
         return view('/backend.advertisers.HirdetesHozzadas');
    }


    public function HirdetesStore(Request $request){
        
        $image = $request->file('foto');
        $name_generate = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();        
        Image::make($image)->resize(800,800)->save('upload/advertiser_images/'.$name_generate);
        $save_url = 'upload/advertiser_images/'.$name_generate;
        $foto_neve = $name_generate;

        $product_id = Advertisers::insertGetId([
            
            
            'name'           => $request->name,
            'email'          => $request->email,
            'phone'          =>$request->phone,
            'password'       => '',
            'leiras'         => $request->leiras,
            'photo'          =>  $foto_neve,
            'created_at'     => Carbon::now(),
            'advertiser_join'=> Carbon::now(),
            'role'           => 'advertiser',
            'status'         => 'active',
            'advertiser_type' => 'basic'
        ]);


        $notification = array(
            'message'    => 'Hirdető sikeresen létrehozva',
            'alert-type' => 'success'
        );

        return redirect()->route('hirdeto.hozzadas')->with($notification);
        
        
    }
    
    
    
    public function OsszesHirdetoBackend(){
        $hirdetok = Advertisers::latest()->get();
        return view('/backend.advertisers.osszes_hirdeto_backend', compact('hirdetok'));
        
    }
    
    
    
    
    
    
    
    public function HirdetoSzerkesztes($id){
    
    /*Komment
    Ha simán csak ->get() lenne a where() után akkor hiba:
    
A hiba azért merül fel, mert a where()->get() metódus egy kollekciót ad vissza, még akkor is, ha csak egyetlen egy elemet vársz vissza a lekérdezésből. A get() metódus eredménye mindig egy kollekció, még akkor is, ha csak egyetlen rekordot ad vissza.

Ebben az esetben, ha tudod, hogy csak egy eredményt vársz vissza a lekérdezésből (mivel az 'id' egyedi azonosító), használhatod a first() metódust, hogy egyetlen modellt kapj vissza, nem pedig egy kollekciót
    
    */
           
     $hirdeto = Advertisers::where('id', $id)->first();
    
     return view('/backend.advertisers.Hirdeto_Szerkesztese', compact('hirdeto'));
    }
    
    
    public function UpdateHirdeto(Request $request){
        
        
         $advertiser_id = $request->id;
    
         Advertisers::findOrFail($advertiser_id)->update([
      
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'leiras' => $request->leiras,

        ]);

        $notification = array(
            'message'    => 'Hirdető sikeresen frissítve',
            'alert-type' => 'success'
        );

        return redirect()->route('osszes.hirdeto.backend')->with($notification);
        
        
    }
    
    
    
}
