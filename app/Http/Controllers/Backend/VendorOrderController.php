<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\OrderItem;   
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Auth;   


class VendorOrderController extends Controller
{
    





    public function VendorOrder(){

        $id= Auth::user()->id;

        // ::with('order') : Az OrderItem Model-ben lévő funkció neve...
        $orderItem = OrderItem::with('order')->where('vendor_id', $id)->orderBy('id', 'DESC')->get();
         return view('vendor.backend.orders.pending_orders', compact('orderItem'));

    }






    public function VendorReturnOrder(){

        $id= Auth::user()->id;      
        $orderItem = OrderItem::with('order')->where('vendor_id', $id)->orderBy('id', 'DESC')->get();
         return view('vendor.backend.orders.return_orders', compact('orderItem'));

    }




        public function VendorComplateReturnOrder(){

        $id= Auth::user()->id;      
        $orderItem = OrderItem::with('order')->where('vendor_id', $id)->orderBy('id', 'DESC')->get();
        return view('vendor.backend.orders.complate_return_orders', compact('orderItem'));

    }



    public function VendorOrderDetails($order_id){

            // Order::with('user') Az Order modell-ben a funkcio neve: user
        $order = Order::with('user')->where('id', $order_id)->first();


        // És pluszban az OrderItem model is bejön a képbe, a product funkciójával:
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();

        return view('vendor.backend.orders.vendor_order_details', compact('order', 'orderItem'));


 }


}
