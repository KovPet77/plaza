<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Compare;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;







class CompareController extends Controller
{
    



    public function AddToCompare(Request $request, $product_id){

  
        // Figyelem
        // Auth::check() : Bejelentkezés ellenőrzése
        if (Auth::check()) {
            $exists = Compare::where('user_id', Auth::id())->where('product_id', $product_id)->first();

         if (!$exists) {

            Compare::insert([

                'user_id' => Auth::id(),
                'product_id' => $product_id,
                'created_at' => Carbon::now(),
            ]);

            return response()->json(['success' => 'Sikeresen hozzáadva az összehasonlításhoz!']);
            
        }else{

            return response()->json(['error' => 'Ez a termék már az összehasonlítási listádon van']);            
         }

        }else{

            return response()->json(['error' => 'Ehhez a művelethez be kell lépned a fiókodba!']);

        }   

    }




    public function AllCompare(){

        return view('frontend.compare.view_compare');
    }




    public function GetCompareProduct(){


        // Wishlist::with('product'): ügye a Wishlist modelben a relationship neve, elnevezése...
        $compare = Compare::with('product')->where('user_id', Auth::id())->latest()->get();

        //$wishQty = compare::count();

        return response()->json($compare);
    }





    public function CompareRemove($id){


        // Csak az Auth-al rendelkező user lekeresése, azaz csak regisztrált
        Compare::where('user_id',Auth::id())->where('id',$id)->delete();

       return response()->json(['success' => 'Termék sikeresen törölve a listádról!']);


    }

}
