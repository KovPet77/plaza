<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Coupon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Auth;






class CheckoutController extends Controller{
    



    // Rendelési adatok begyűjtése:
    public function CheckoutStore(Request $request){
        
        
        
       #return view('frontend.payment.inactivewebsite');
       
       
       
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_address'] = $request->shipping_address;
        $data['post_code'] = $request->post_code;
        $data['notes'] = $request->notes;
        $cartTotal = Cart::total();
        $carts = Cart::content();

        if ($request->payment_option == 'stripe') {               


            // Stripe
            return view('frontend.payment.stripe', compact('data','carts','cartTotal'));

        }elseif($request->payment_option == 'card'){

            return 'Kártyás Fizetés...';

        }else{
            // Utánvétes
            return view('frontend.payment.cash', compact('data','carts','cartTotal'));

        }
      

    }


}
