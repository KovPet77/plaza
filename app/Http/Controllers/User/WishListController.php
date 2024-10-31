<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;



class WishListController extends Controller{
    


    public function AddToWishList(Request $request, $product_id){

  
        // Figyelem
        // Auth::check() : Bejelentkezés ellenőrzése
        if (Auth::check()) {
            $exists = Wishlist::where('user_id', Auth::id())->where('product_id', $product_id)->first();

         if (!$exists) {

            Wishlist::insert([

                'user_id' => Auth::id(),
                'product_id' => $product_id,
                'created_at' => Carbon::now(),
            ]);

            return response()->json(['success' => 'Sikeresen hozzáadva a kívánságlistához!']);
            
        }else{

            return response()->json(['error' => 'Ez a termék már a kívánságlistádon van']);            
         }

        }else{

            return response()->json(['error' => 'Ehhez a művelethez be kell lépned a fiókodba!']);

        }   

    }


    public function AllWishList(){

        return view('frontend.wishlist.view_wishlist');

    }


    public function GetWishListProduct(){


        // Wishlist::with('product'): ügye a Wishlist modelben a relationship neve, elnevezése...
        $wishlist = Wishlist::with('product')->where('user_id', Auth::id())->latest()->get();

        $wishQty = wishlist::count(); // Itt számolja a record-okat, amik a kis számkánt jelenek meg

        return response()->json([

            'wishlist' => $wishlist,
            'wishQty' => $wishQty

        ]);
    }




    public function RemoveWishlist($id){


        // Csak az Auth-al rendelkező user lekeresése, azaz csak regisztrált
        Wishlist::where('user_id',Auth::id())->where('id',$id)->delete();

       return response()->json(['success' => 'Termék sikeresen törölve a kívánságlistádról!']);


    }




}
