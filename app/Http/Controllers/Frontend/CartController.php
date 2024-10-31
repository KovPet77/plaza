<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\Product;
use App\Models\Coupon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Auth;


class CartController extends Controller{





    public function AddToCart(Request $request, $id){


        // Ez a kupon törlés azért kell, mert visszamehet a kosárból a főoldalra és
        // bedobálhat új termékeket. 
        // Újra meg kell adnia a kupon és a rendszernek újra kell kalkulálnia, ellenkező esetben
        // valami false érték jöhet ki
        if (Session::has('coupon')) {
            
            Session::forget('coupon');
        }


        $product = Product::findOrFail($id);

        // Ha nincs diszkont ár
        if ($product->discount_price == NULL) {
                
            Cart::add([

                'id'      => $id,
                'name'    => $request->product_name,
                'qty'     => $request->quantity,
                'price'   => $product->selling_price,
                'weight'  => 1,
                'options' => [

                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'size'  => $request->size,
                    'vendor_id'  => $request->vendor_id,
                ],
            ]);

            return response()->json(['success' => 'Termék sikeresen hozzáadva a kosárhoz!']);

        // Ha van diszkont ár
        }else{


            Cart::add([

                'id'      => $id,
                'name'    => $request->product_name,
                'qty'     => $request->quantity,
                'price'   => $product->discount_price,
                'weight'  => 1,
                'options' => [

                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'size'  => $request->size,
                    'vendor_id'  => $request->vendor_id,
                ],
            ]);

            return response()->json(['success' => 'Termék sikeresen hozzáadva a kosárhoz!']);

        }

    }



public function AddMiniCart() {
    $carts = Cart::content();
    $cartQty = Cart::count();
    $cartTotal = Cart::total();

    // Magyar forint formátumba alakítás
    $formattedCartTotal = number_format($cartTotal, 0, ',', ' ') . ' Ft';

    return response()->json(array(
        'carts' => $carts,
        'cartQty' => $cartQty,
        'cartTotal' => $formattedCartTotal
    )); 
}



    public function RemoveMiniCart($rowId){

        Cart::remove($rowId);

        Session::put('rendelesValidacio','ervenytelen');
        return response()->json(['success' => 'Termék törölve a kosárból!']);

    }




    public function AddToCartDetails(Request $request, $id){

        $product = Product::findOrFail($id);

        if ($product->discount_price == NULL) {
            
            Cart::add([

                'id'      => $id,
                'name'    => $request->product_name,
                'qty'     => $request->quantity,
                'price'   => $product->selling_price,
                'weight'  => 1,
                'options' => [

                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'size'  => $request->size,
                    'vendor'  => $request->vendor,
                ],
            ]);

            return response()->json(['success' => 'Termék sikeresen hozzáadva a kosárhoz!']);

        }else{


            Cart::add([

                'id'      => $id,
                'name'    => $request->product_name,
                'qty'     => $request->quantity,
                'price'   => $product->discount_price,
                'weight'  => 1,
                'options' => [

                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'size'  => $request->size,
                    'vendor'  => $request->vendor,
                ],
            ]);

            return response()->json(['success' => 'Termék sikeresen hozzáadva a kosárhoz!']);

        }

    }



    public function MyCart(){


        return view('frontend.mycart.view_mycart');
    }



    public function GetCartProduct(){

        // Az installált Cart packageből az adatok kinyerése

        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();
        return response()->json(array(

            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal
        )); 


    }



    public function CartRemove($rowId){

         
        
        Cart::remove($rowId);

            // Session-ben kap egy ervenytelen értéket a rendelesValidacio kulcs, ha törölt mindent a kiskosárból,de tovább akarja nyomkodni az üres kosárral...😖😡👽
        Session::put('rendelesValidacio','ervenytelen');

            // Törlés utáni kupon frissítés, különben ugyanaz marad a kupon százalék értéke, ha töröl terméket:

        if (Session::has('coupon')) {
            
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name', $coupon_name)->first();

           Session::put('coupon', [

            'coupon_name' => $coupon->coupon_name,
            'coupon_discount' => $coupon->coupon_discount,
            'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100),
            'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100),
        ]);
       }
        return response()->json(['success' => 'Termék sikeresen törölve a kosárból!']);

    }  


    public function CartDecrement($rowId){

       $row = Cart::get($rowId);

       Cart::update($rowId, $row->qty -1);

       // Ez amikor a darabszámot nyomogatja kosár oldalon, azért kell, mert különben nem frissül az ár, ha van kupon
       if (Session::has('coupon')) {
            
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name', $coupon_name)->first();

           Session::put('coupon', [

            'coupon_name' => $coupon->coupon_name,
            'coupon_discount' => $coupon->coupon_discount,
            'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100),
            'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100),
        ]);
       }


        return response()->json(['success']);

    }    



      public function CartIncrement($rowId){

       $row = Cart::get($rowId);

       Cart::update($rowId, $row->qty +1);

       
       // Ez amikor a darabszámot nyomogatja kosár oldalon, azért kell, mert különben nem frissül az ár, ha van kupon
       if (Session::has('coupon')) {
            
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name', $coupon_name)->first();

           Session::put('coupon', [

            'coupon_name' => $coupon->coupon_name,
            'coupon_discount' => $coupon->coupon_discount,
            'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100),
            'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100),
        ]);
       }
        return response()->json(['success']);

    }



    public function CouponApply(Request $request){

        $coupon = Coupon::where('coupon_name', $request->coupon_name)->where('coupon_validity', '>=', Carbon::now()->format('Y-m-d'))->first();

        if ($coupon) {
            
            Session::put('coupon', [

                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100),
            ]);

            return response()->json(array(

                'validity' => true,
                'success' => 'Kupon sikeresen alkalmazva'
            ));

        }else{


            return response()->json(array(

                'error' => 'Érvénytelen kupon'
            ));
        }

    }


    public function CouponCalculation(){


        // Kuponnal
        if (Session::has('coupon')) {
            
            return response()->json(array(

                'subtotal' => Cart::total(),
                'coupon_name' => session()->get('coupon')['coupon_name'],
                'coupon_discount' => session()->get('coupon')['coupon_discount'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount' => session()->get('coupon')['total_amount'],
            ));

        // Kupon nélkül   
        }else{

            return response()->json(array(

                'total' => Cart::total(),
            ));
        }


    }



    public function CouponRemove(){

        Session::forget('coupon');

        return response()->json(['success' => 'Kupon törlése sikeres']);
    }



    public function checkoutCreate(){



         # Ha azt akarjuk, hogy csak regisztráltak tudjanak vásárolni:   
        /*
        if (Auth::check()) {
            
            if (Cart::total() > 0) {
               
              $carts = Cart::content();
              $cartQty = Cart::count();
              $cartTotal = Cart::total();

              return view('frontend.checkout.checkout_view', compact('carts', 'cartQty', 'cartTotal'));

            }else{

            $notification = array(
                'message' => 'Nincs termék a kosárba téve!',
                'alert-type' => 'error'
            );

            return redirect()->to('/')->with($notification);
            }

        }else{

            $notification = array(

                'message' => 'Ehhez a művelethez be kell jelentkezned',
                'alert-type' => 'error'
            );

            return redirect()->route('login')->with($notification);
        }

           */

            if (Cart::total() > 0) {
               
              $carts = Cart::content();
              $cartQty = Cart::count();
              $cartTotal = Cart::total();

              return view('frontend.checkout.checkout_view', compact('carts', 'cartQty', 'cartTotal'));

            }else{

            $notification = array(
                'message' => 'Nincs termék a kosárba téve!',
                'alert-type' => 'error'
            );

            return redirect()->to('/')->with($notification);
            }
    }


}

