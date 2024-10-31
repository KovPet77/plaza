@extends('dashboard') 
@section('user')
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


  <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Kezdőlap</a>
                    <span></span> Rendeléseim
                </div>
            </div>
        </div>
        <div class="page-content pt-50 pb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 m-auto">
<div class="row">



 @include('frontend.body.dashboard_sidebar_menu')


<div class="col-md-9">


    <div class="row">
        
        <div class="col-md-6">
            
            <div class="card">
                <div class="card-header"><h4>Szállítási információk</h4></div>
                <hr>

                <div class="card-body">
                    <table class="table" style="background:#ddd; font-weight:600;">
                        <tr>
                            <th>Megrendelő neve</th>
                            <th>{{ $order->name }}</th>
                        </tr>
                        <tr>
                            <th>Email:</th>
                             <th>{{ $order->email }}</th>
                        </tr>
                        <tr>
                            <th>Cím:</th>
                            <th>{{ $order->address }}</th>
                        </tr>
                        <tr>
                            <th>Irányítószám</th>
                            <th>{{ $order->post_code }}</th>
                        </tr>
                        <tr>
                            <th>Telefonszám</th>
                            <th>{{ $order->phone }}</th>
                        </tr>

                        <tr>
                            <th>Dátum</th>
                            <th>{{ $order->order_date }}</th>
                        </tr>                  
                    </table>
                </div>
            </div>      
        </div>





        <div class="col-md-6">
            
            <div class="card">
                <div class="card-header"><h4>Rendelés adatai</h4>

                    <span class="text-danger">Számla: {{ $order->invoice_no }}</span>
                </div>
                <hr>

                <div class="card-body">
                    <table class="table" style="background:#ddd; font-weight:600;">
                        <tr>
                            <th>Megrendelő neve</th>
                            <th>{{ $order->user->name }}</th>
                        </tr>
                        <tr>
                            <th>Telefon</th>
                            <th>{{ $order->user->phone }}</th>
                        </tr>
                        <tr>
                            <th>Fizetési mód</th>
                            <th>{{ $order->payment_method }}</th>
                        </tr>
                        <tr>
                            <th>Tranzakció ID</th>
                            <th>{{ $order->transaction_id }}</th>
                        </tr>
                        <tr>
                            <th>Számla</th>
                            <th class="text-danger">{{ $order->invoice_no}}</th>
                        </tr>
                        <tr>
                            <th>Összeg</th>
                            <th>{{ $order->amount }}</th>
                        </tr>
                        <tr>
                            <th>Rendelés státusza</th>
                            <th> <span class="badge rounded-pill bg-warning">{{ $order->status }}</span>
                            </th>
                        </tr>
                    </table>
                </div>
            </div>      
        </div>
    </div>


   </div>





                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table" style="font-weight: 600;">
                            <tbody>
                                <tr>
                                    <td class="col-md-1">
                                        <label>Fotó</label>
                                    </td>
                                    <td class="col-md-2">
                                        <label>Termék neve</label>
                                    </td>
                                    <td class="col-md-2">
                                        <label>Eladó neve</label>
                                    </td>
                                    <td class="col-md-2">
                                        <label>Termék kód</label>
                                    </td>
                                    <td class="col-md-1">
                                        <label>Szín</label>
                                    </td>
                                    <td class="col-md-1">
                                        <label>Méret</label>
                                    </td>
                                    <td class="col-md-1">
                                        <label>Darabszám</label>
                                    </td>
                                    <td class="col-md-3">
                                        <label>Ár</label>
                                    </td>
                                </tr>

                                @foreach($orderItem as $item)
                                 <tr>
                                    <td class="col-md-1">
                                        <label><img src="{{ asset($item->product->product_thumbnail )}}" style="width:50px; height: 50px;"></label>
                                    </td>
                                    <td class="col-md-2">
                                        <label>{{ $item->product->product_name }}</label>
                                    </td>

                                    @if($item->vendor_id == NULL)
                                    <td class="col-md-2">
                                        <label>Pláza tulajdonosa</label>
                                    </td>
                                    @else
                                     <td class="col-md-2">
                                        <!-- Ez a vendor speciel a Product model-ből jön, ott van egy belongsto()-->
                                        <label>{{ $item->product->vendor->name}}</label>
                                    </td>
                                    @endif

                                    <td class="col-md-2">
                                        <label>{{ $item->product->product_code }}</label>
                                    </td>

                                    @if($item->color == NULL)
                                     <td class="col-md-1">
                                        <label>...</label>
                                    </td>
                                    @else
                                     <td class="col-md-1">
                                        <label>{{ $item->color }}</label>
                                    </td>
                                    @endif
                                  
                                     @if($item->size == NULL)
                                     <td class="col-md-1">
                                        <label>...</label>
                                    </td>
                                    @else
                                     <td class="col-md-1">
                                        <label>{{ $item->size }}</label>
                                    </td>
                                    @endif


                                    
                                    <td class="col-md-1">
                                        <label>{{ $item->qty }}</label>
                                    </td>
                                    <td class="col-md-3">
                                        <label>{{ $item->price }} <br> Végösszeg = {{ $item->price * $item->qty }} Ft. </label>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                @if($order->status !== 'delivered')

                @else

                @php
                $order = App\Models\Order::where('id', $order->id)->where('return_reason', '=', NULL)->first();
                @endphp

                @if($order)
                <form method="post" action="{{ route('return.order', $order->id)}}">
                    @csrf
                <div class="form-group" style="font-weight:600; font-size: initial;">
                    <label>Rendelés visszaküldésének oka</label>

                    <textarea name="return_reason" class="form-control">
                        
                    </textarea>
                    <br>

                    <button class="btn btn-danger">Rendelés visszaküldése</button>
                </div>
                </form>

                @else
                    <h5><span style="color: red;">Erre a termékre már elküldted a visszatérítési kérelmet!</span></h5>
                @endif
                @endif






            </div>
        </div>


@endsection