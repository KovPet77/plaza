<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\OrderItem;   
use App\Models\Product;   
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Auth;
use DB;



class OrderController extends Controller
{
    


    public function PendingOrder(){

        $orders = Order::where('status', 'pending')->orderBy('id', 'DESC')->get();
         return view('backend.orders.pending_orders', compact('orders'));

    }

    /*
        public function PendingOrder() {
            $orders = Order::where('status', 'pending')
                           ->orderBy('id', 'DESC')
                           ->groupBy('transaction_id')
                           ->get();
            return view('backend.orders.pending_orders', compact('orders'));
        }
*/


    public function AdminOrderDetails($order_id){

        // Order::with('user') Az Order modell-ben a funkcio neve: user
        $order = Order::with('user')->where('id', $order_id)->first();



        // És pluszban az OrderItem model is bejön a képbe, a product funkciójával:
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        #dd($orderItem);
        return view('backend.orders.admin_order_details', compact('order', 'orderItem'));

    }


    public function AdminConfirmedOrder(){

        $orders = Order::where('status', 'confirm')->orderBy('id', 'DESC')->get();
         return view('backend.orders.confirm_orders', compact('orders'));

    }


    public function AdminProcessingOrder(){

        $orders = Order::where('status', 'processing')->orderBy('id', 'DESC')->get();
         return view('backend.orders.processing_orders', compact('orders'));

    }


    public function AdminDeliveredgOrder(){

        $orders = Order::where('status', 'delivered')->orderBy('id', 'DESC')->get();
         return view('backend.orders.delivered_orders', compact('orders'));

    }




    public function PendingToConfirm($order_id){


        Order::findOrFail($order_id)->update(['status' => 'confirm']); // update: mit-mire....


        $notification = array(
                'message'    => 'Rendelés sikeresen megerősítve!',
                'alert-type' => 'success'
            );
            return redirect()->route('admin.confirmed.order')->with($notification);
    }




    public function ConfirmToProcessing($order_id){


        Order::findOrFail($order_id)->update(['status' => 'processing']); // update: mit-mire....


        $notification = array(
                'message'    => 'Rendelés feldolgozás alatt!',
                'alert-type' => 'success'
            );
            return redirect()->route('admin.processing.order')->with($notification);
    }



    public function ProcessingToDelivered($order_id){

        ////////// Ez itt a készlet kezeléshez van utólag felvéve://///////////////
        $product = OrderItem::where('order_id', $order_id)->get();

        foreach($product as $item){

            Product::where('id',$item->product_id)->update(
                ['product_qty' => DB::raw('product_qty-'.$item->qty)

            ]);
        }

        ////////// Ez itt a készlet kezeléshez van utólag felvéve://///////////////




        Order::findOrFail($order_id)->update(['status' => 'delivered']); // update: mit-mire....
        $notification = array(
                'message'    => 'Rendelés szállítás alatt megerősítve!',
                'alert-type' => 'success'
            );
            return redirect()->route('admin.delivered.order')->with($notification);
    }  




    // Számla generálása-letöltése
    public function AdminInvoiceDownload($order_id){

        // Order::with('user') Az Order modell-ben a funkcio neve: user
        $order = Order::with('user')->where('id', $order_id)->first();


        // És pluszban az OrderItem model is bejön a képbe, a product funkciójával:
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();

        $pdf = Pdf::loadView('backend.orders.admin_order_invoice',compact('order', 'orderItem'))->setPaper('a4')->setOption([

            'tempDir' => public_path(),
            'chroot'  => public_path()
        ]);
        return $pdf->download('invoice.pdf');

    } 
}
