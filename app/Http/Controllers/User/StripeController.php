<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;
use App\Mail\OrderMail2;
use Auth;
use App\Notifications\OrderComplete;
use Illuminate\Support\Facades\Notification;






class StripeController extends Controller{




    public function StripeOrder(Request $request){
        
        #dd($request);

        /*
       $rendelesValidacio = Session::get('rendelesValidacio');
       dd($rendelesValidacio);
       if ($rendelesValidacio) {
              Session::forget('rendelesValidacio');
       
       }else{
         return view('/frontend/payment/invalid_order');
       }

     */
     




            if (Session::has('coupon')) {
                
            // CartController CouponApply-ban van ez beállítva:
                $total_amount = Session::get('coupon')['total_amount'];
            }else{

                $total_amount = round(Cart::total());
            }


            // Set your secret key. Remember to switch to your live secret key in production.
            // See your keys here: https://dashboard.stripe.com/apikeys
            \Stripe\Stripe::setApiKey('sk_test_51LWhvFGCfdtm6mMBVCOYxbdvvD0yc9IuWRo3LaIKd59JHzkPiXwTx1Fa3H2OyIPORIGP3Q8UOa5TVDZkMDbCk4pO00Tm3nNPEN');

            // Token is created using Checkout or Elements!
            // Get the payment token ID submitted by the form:
            $token = $_POST['stripeToken'];

            $charge = \Stripe\Charge::create([
              'amount' => $total_amount * 100,
              'currency' => 'huf',
              'description' => 'Pláza Webshop',
              'source' => $token,
              'metadata' => ['order_id' => uniqid()],
            ]);

            //dd($charge);


            // Rendelés adatbázisba illesztése:
           
           
            $data           = [];
            $emailEladonak  = [];
            $transaction_id = rand(100, 800000);
            $content        = Cart::content();
            $vendor_id      = [];
            #dd($content);
            //Ezek az adatok kerülnek az emailbe: 
            foreach($content as $cont){

               $vendor_id = $cont->options->get('vendor');
                if (!isset($emailEladonak[$vendor_id])) {
                    $user = User::where('id', $vendor_id)->first(); // Csak az első találatra van szükségünk
                    if ($user) {
                        $emailEladonak[$vendor_id] = $user->email; // Csak az email címet tároljuk el
                    }
                }
       
         
            
            $data[] = [

            'termekek'       => $cont->name,
            'price'          => $cont->price,
            'qty'            => $cont->qty,
            'image'          => $cont->options->image, // Hozzáfűzés az adatokhoz
            'transaction_id' => $transaction_id  
            #'email' => $invoice->email,
            ];

            $mail = new OrderMail($data);    

            $user = User::where('role', 'admin')->get();   
            if (Session::has('coupon')) {
                
            // CartController CouponApply-ban van ez beállítva:
                $total_amount = Session::get('coupon')['total_amount'];
            }else{

                $total_amount = round(Cart::total());
            }

           
            foreach ($emailEladonak  as $ertek) {
                $stringErtek1 = (string) $ertek;
                #echo $stringErtek . "<br>";
            }

        
            #dd($vendor_id);

            // Rendelés adatbázisba illesztése utánvétes:
            $ip_address = $_SERVER['REMOTE_ADDR'];
            $order_id = Order::insertGetId([

                'user_id'           => Auth::id(), 
                'vendor_id'         => $vendor_id, 
                'name'              => $request->name, 
                'email'             => $request->email, 
                'adatkezeles'       => $request->adatkezeles, 
                'felhasznaloi_feltetelek'       => $request->felhasznaloi, 
                'ip_cim'            => $ip_address, 
                'elado_email_cime'  => $stringErtek1, 
                'email_kikuldve'    => 'nincsKikuldve', 
                'phone'             => $request->phone, 
                'address'           => $request->address, 
                'post_code'         => $request->post_code, 
                'notes'             => $request->notes, 
                'product_name'      => $cont->name, 
                'product_price'     => $cont->price, 
                'product_qty'       => $cont->qty, 

                'payment_type' => $charge->payment_method, 
                'payment_method' => 'Stripe', 
                'transaction_id' => $charge->balance_transaction, 
                'currency' => $charge->currency, 
                'order_number' => $charge->metadata->order_id,
                'adatkezeles' => 'elfogadva',
                'felhasznaloi_feltetelek' => 'elfogadva',

                'amount'            => $total_amount, 

                'invoice_no'        => 'Plaza'.mt_rand(10000000, 99999999), 
                'order_date'        => Carbon::now()->format('d F Y'), 
                'order_mounth'      => Carbon::now()->format('F'), 
                'order_year'        => Carbon::now()->format('Y'),             
                                   
                'status'            => 'pending', 
                'created_at'        =>Carbon::now(), 
                 
            ]);

            }
           
           
           


 /*                             Email küldése
  =============================================================================
*/

        $invoice = Order::findOrFail($order_id);

        $data = [

            'invoice_no' => $invoice->invoice_no,
            'amount' => $total_amount,
            'name' => $invoice->name,
            'email' => $invoice->email,
        ];

        //Mail::to($request->email)->send(new OrderMail($data));
        $mail = new OrderMail($data);

        // Levél küldése
        Mail::to($request->email)->send($mail);



/*
  =============================================================================*/    
  
  
  
             // Levél küldése
             Mail::to($request->email)->send($mail);

             $eladoRendelese = Order::where('email_kikuldve', 'nincsKikuldve')->get();
                #dd($eladoRendelese);
                
                // Ez megy az eladónak a rendelés adataival:
                foreach ($eladoRendelese as $ertek) {

                    $data = [];
                    
                    $data[] = [
                        'product_name'     => $ertek['product_name'],
                        'price'            => $ertek['product_price'],
                        'qty'              => $ertek['product_qty'],
                        'email'            =>$request->email,
                        'address'          => $ertek['address'],
                        'phone'            => $ertek['phone'], 
                        'name'             => $ertek['name'], 
                        'notes'            => $ertek['notes'], 
                        'post_code'        => $ertek['post_code'], 
                    ];
    
                    $ertek->email_kikuldve = 'kikuldve';
                    $ertek->save();
                    $mail = new OrderMail2($data);
                    Mail::to($ertek['elado_email_cime'])->send($mail);
              
                     }


            if (Session::has('coupon')) {
                Session::forget('coupon');
            }

            Cart::destroy();

             $notification = array(
            'message'    => 'Sikeres rendelés!',
            'alert-type' => 'success'
        );

        return view('frontend.siker')->with($notification);
                    
    }

















































































        public function CashOrder(Request $request){


          $ip_address = $_SERVER['REMOTE_ADDR'];

         // Ha a session rendelesValidacio értéke ervenytelen, az azt jelenti, hogy a kiskosárból már törölte
         // de tovább akarna menni üres kosárral, véglegesíteni...
          $rendelesValidacio = Session::get('rendelesValidacio');
          #dd($rendelesValidacio);
          /*
           if ($rendelesValidacio) {
                  Session::forget('rendelesValidacio');
           
           }else{
             return view('/frontend/payment/invalid_order');
           }

          */        
          
          
          /*
        $carts = Cart::content();
       foreach ($carts as $cartItem) {
        $vendor_id = $cartItem->options->vendor;       
       #dd($vendor_id);
       }

       $eladoMail = User::findOrFail($vendor_id);
       $elado_email_cime =  $eladoMail->email;
       #dd($elado_email_cime);
          */
          
          

            $data           = [];
            $emailEladonak  = [];
            $transaction_id = rand(100, 800000);
            $content        = Cart::content();
            $vendor_id      = [];
            #dd($content);
            //Ezek az adatok kerülnek az emailbe: 
            foreach($content as $cont){

               $vendor_id = $cont->options->get('vendor');
                if (!isset($emailEladonak[$vendor_id])) {
                    $user = User::where('id', $vendor_id)->first(); // Csak az első találatra van szükségünk
                    if ($user) {
                        $emailEladonak[$vendor_id] = $user->email; // Csak az email címet tároljuk el
                    }
                }
       
            #dd($emailEladonak);
            
            $data[] = [

            'termekek'       => $cont->name,
            'price'          => $cont->price,
            'qty'            => $cont->qty,
            'image'          => $cont->options->image, // Hozzáfűzés az adatokhoz
            'transaction_id' => $transaction_id  
            #'email' => $invoice->email,
            ];

            $mail = new OrderMail($data);    

            $user = User::where('role', 'admin')->get();   
            if (Session::has('coupon')) {
                
            // CartController CouponApply-ban van ez beállítva:
                $total_amount = Session::get('coupon')['total_amount'];
            }else{

                $total_amount = round(Cart::total());
            }

            
            foreach ($emailEladonak  as $ertek) {
                $stringErtek = (string) $ertek;
                #echo $stringErtek . "<br>";
                #dd($stringErtek);
            }

        


            // Rendelés adatbázisba illesztése utánvétes:
            $ip_address = $_SERVER['REMOTE_ADDR'];
            $order_id = Order::insertGetId([

                'user_id'           => Auth::id(), 
                'vendor_id'         => $vendor_id, 
                'name'              => $request->name, 
                'email'             => $request->email, 
                'adatkezeles'       => $request->adatkezeles, 
                'felhasznaloi_feltetelek'       => $request->felhasznaloi, 
                'ip_cim'            => $ip_address, 
                'elado_email_cime'  => $stringErtek, 
                'email_kikuldve'    => 'nincsKikuldve', 
                'phone'             => $request->phone, 
                'address'           => $request->address, 
                'post_code'         => $request->post_code, 
                'notes'             => $request->notes, 
                'product_name'      => $cont->name, 
                'product_price'     => $cont->price, 
                'product_qty'       => $cont->qty, 

                'payment_type'      => 'Utanvetes fizetes', 
                'payment_method'    => 'Utanvetes fizetes', 
                'transaction_id'    => $transaction_id,
               
                'currency'          => 'HUF', 
                'amount'            => $total_amount, 

                'invoice_no'        => 'Plaza'.mt_rand(10000000, 99999999), 
                'order_date'        => Carbon::now()->format('d F Y'), 
                'order_mounth'      => Carbon::now()->format('F'), 
                'order_year'        => Carbon::now()->format('Y'),             
                                   
                'status'            => 'pending', 
                'created_at'        =>Carbon::now(), 
                 
            ]);

            }

            #dd($data);
            //Mail::to($request->email)->send(new OrderMail($data));
            #dd(Cart::content());

             // Levél küldése
             Mail::to($request->email)->send($mail);


             $eladoRendelese = Order::where('email_kikuldve', 'nincsKikuldve')->get();


                // Ez megy az eladónak a rendelés adataival:
                foreach ($eladoRendelese as $ertek) {

                    $data2 = [];
                    
                    $data2[] = [
                        'product_name'     => $ertek['product_name'],
                        'price'            => $ertek['product_price'],
                        'qty'              => $ertek['product_qty'],
                        'email'            =>$request->email,
                        'address'          => $ertek['address'],
                        'phone'            => $ertek['phone'], 
                        'name'             => $ertek['name'], 
                        'notes'            => $ertek['notes'], 
                        'post_code'        => $ertek['post_code'], 
                    ];
    
                    $ertek->email_kikuldve = 'kikuldve';
                    $ertek->save();
                    $mail = new OrderMail2($data2);
                    Mail::to($ertek['elado_email_cime'])->send($mail);
              
                     }

                    #dd($eladoRendelese);          



 /*                             Email küldése
  =============================================================================
*/
 
        #$invoice = Order::findOrFail($order_id);

/*
  =============================================================================
 */            


            // Rendelés beillesztése adatbázisba
            $carts = Cart::content();


            foreach ($carts as $cart) {
                
                OrderItem::insert([

                    'order_id' => $order_id,
                    'product_id' => $cart->id,
                    'vendor_id' => $cart->options->vendor,
                    'color' => $cart->options->color,
                    'size' => $cart->options->size,
                    'qty' => $cart->qty,
                    'price' => $cart->price,
                    'created_at' => Carbon::now(),
                    


                ]);
            }



            if (Session::has('coupon')) {
                Session::forget('coupon');
            }

            Cart::destroy();

             $notification = array(
            'message'    => 'Sikeres rendelés!',
            'alert-type' => 'success'
        );

        // Komment. Értesítés küldése az adminnak a rendelésről
        Notification::send($user, new OrderComplete($request->name));

        return view('frontend.siker')->with($notification);
                    
    }
    
}
