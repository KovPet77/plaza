<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;



class AllUserController extends Controller
{
    


    public function UserIndex()
    {
      

         return view('frontend.userdashboard.user_index');
    }




    public function UserAccount(){

        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('frontend.userdashboard.account_details', compact('userData'));
    }




       public function UserChangePassword(){

        return view('frontend.userdashboard.user_change_password');
            
    }



    public function UserOrderPage(){

        $id = Auth::user()->id;
        $orders = Order::where('user_id', $id)->orderBy('id','DESC')->get();
        return view('frontend.userdashboard.user_order_page', compact('orders'));

    }



    // User rendelései menüpontban a fa fa-eye href url-re kattintva fut le
    public function UserOrderDetails($order_id){

        // Order::with('user') Az Order modell-ben a funkcio neve: user
        $order = Order::with('user')->where('id', $order_id)->where('user_id', Auth::id())->first();


        // És pluszban az OrderItem model is bejön a képbe, a product funkciójával:
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();

        return view('frontend.order.order_details', compact('order', 'orderItem'));

    }




    // Számla generálása-letöltése
    public function UserOrderInvoice($order_id){

        // Order::with('user') Az Order modell-ben a funkcio neve: user
        $order = Order::with('user')->where('id', $order_id)->where('user_id', Auth::id())->first();


        // És pluszban az OrderItem model is bejön a képbe, a product funkciójával:
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();

        $pdf = Pdf::loadView('frontend.order.order_invoice',compact('order', 'orderItem'))->setPaper('a4')->setOption([

            'tempDir' => public_path(),
            'chroot'  => public_path()
        ]);
        return $pdf->download('invoice.pdf');

    }




    public function ReturnOrder(Request $request, $order_id){

        Order::findOrFail($order_id)->update([

            'return_date' => Carbon::now()->format('d f Y'),
            'return_reason' => $request->return_reason,
            'return_order' => 1
        ]);

        $notification = array(
            'message'    => 'Rendelés visszaküldési kérés elküldve',
            'alert-type' => 'success'
        );

        return redirect()->route('user.order.page')->with($notification);

    }





    public function ReturnOrderPage(){


        $orders = Order::where('user_id', Auth::id())->where('return_reason', '!=', NULL )->orderBy('id', 'DESC')->get();
        return view('frontend.order.return_order_view', compact('orders'));
    }  






    public function UserTrackOrder(){

        return view('frontend.userdashboard.user_track_order');
    }   





     public function OrderTracking(Request $request){


        $invoice = $request->code;

        // Figyelem.
        // Az order táblában, ahol az invoice_no megegyezik a post kérésben szereplő $invoice-al..
        $track = Order::where('invoice_no', $invoice)->first();

        # Ha van találat a számla sorszámra:
        if ($track) {
            
        return view('frontend.tracking.track_order', compact('track'));

        }else{

             $notification = array(
            'message'    => 'Nem létező számla sorszám!',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
        }

    }


}
