<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use Carbon\Carbon;



class CouponController extends Controller{



    public function AllCoupon()
    {
         // Latest data megszerzése a Coupon modeltől:
        $coupon = Coupon::latest()->get();
        return view('backend.coupon.coupon_all', compact('coupon'));
    }


    public function AddCoupon(){

        return view('backend.coupon.coupon_add');



    }





        public function StoreCoupon(Request $request)
    {   
               

        Coupon::insert([
            
            'coupon_name'     => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'created_at'      => Carbon::now()
           
            

        ]);

        // Toast message frissítéskor
        $notification = array(
            'message'    => 'Kupon sikeresen létrehozva',
            'alert-type' => 'success'
        );

        return redirect()->route('all.coupon')->with($notification);
    }




    public function EditCoupon($id){

        $coupon = Coupon::findOrFail($id);

        return view('backend.coupon.edit_coupon', compact('coupon'));
    }


    public function UpdateCoupon(Request $request){

           $coupon_id = $request->id;

            Coupon::findOrFail($coupon_id)->update([
            
            'coupon_name'     => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'created_at'      => Carbon::now()
           
            

        ]);

        // Toast message frissítéskor
        $notification = array(
            'message'    => 'Kupon sikeresen szerkesztve',
            'alert-type' => 'success'
        );

        return redirect()->route('all.coupon')->with($notification);
    }




        public function DeleteCoupon($id)
    {
        Coupon::findOrFail($id)->delete();
        $notification = array(
            'message'    => 'Kupon sikeresen törölve',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    
}
