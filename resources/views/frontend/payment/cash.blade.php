@extends('frontend.master_dashboard')
@section('main')
@section('title')
Utánvétes fizetés
@endsection

        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Kezdőlap</a> 
                    <span></span> Utánvétes fizetés
                </div>
            </div>
        </div>
        <div class="container mb-80 mt-50">
            <div class="row">
                <div class="col-lg-8 mb-40">
                    <h3 class="heading-2 mb-10">Utánvétes fizetés</h3>
                    <div class="d-flex justify-content-between">
                        
                    </div>
                </div>
            </div>



<div class="row">
<div class="col-lg-6">
@php
if($cartTotal > 0){
@endphp  
    <div class="border p-40 cart-totals ml-30 mb-50">
   
        <h4>Rendelés adatai</h4>



        <table class="table no-border">
            <tbody>
                @foreach($carts as $item)
                <tr>
                    <td class="image product-thumbnail"><img src="{{ asset($item->options->image)}}" alt="#"></td>
                    <td>
                        <h6 class="w-160 mb-5">
                            <a href="#" class="text-heading">{{ $item->name}}</a></h6></span>
                        <div class="product-rate-cover">
        
                             
                        </div>
                    </td>
                    <td>
                <h6 class="text-muted pl-20 pr-20">x{{ $item->qty}}</h6>
                    </td>
                    <td>
                        <h4 class="text-brand">{{number_format($item->price, 0, ',', ' ') . ' Ft.'}}</h4>
                    </td>
                </tr>
                @endforeach
 
            </tbody>
        </table>






      

    <div class="divider-2 mb-30"></div>
    <div class="table-responsive order_table checkout">


 <table class="table no-border">
        <tbody>
        @if(Session::has('coupon'))
              <tr>
                <td class="cart_total_label">
                    <h6 class="text-muted">Részösszeg</h6>
                </td>
                <td class="cart_total_amount">
                    <h4 class="text-brand text-end">{{ $cartTotal}} Ft.</h4>
                </td>
            </tr>
            
            <tr>
                <td class="cart_total_label">
                    <h6 class="text-muted">Kupon neve</h6>
                </td>
                <td class="cart_total_amount">
                    <h6 class="text-brand text-end">{{ session()->get('coupon')['coupon_name'] }} ({{session()->get('coupon')['coupon_discount']}} %) </h6>
                </td>
            </tr>

              <tr>
                <td class="cart_total_label">
                    <h6 class="text-muted">Kupon diszkont</h6>
                </td>
                <td class="cart_total_amount">
                    <h4 class="text-brand text-end">{{session()->get('coupon')['discount_amount']}} Ft.</h4>
                </td>
            </tr>

              <tr>
                <td class="cart_total_label">
                    <h6 class="text-muted">Fizetendő</h6>
                </td>
                <td class="cart_total_amount">
                    <h4 class="text-brand text-end">{{session()->get('coupon')['total_amount']}} Ft.</h4>
                </td>
            </tr>

        @else
            <tr>
            
                <td class="cart_total_label">
                    <h6 class="text-muted">Fizetendő</h6>
                </td>
                <td class="cart_total_amount"> 
                   
                    <h4 class="text-brand text-end">{{ number_format($cartTotal, 0, ',', ' ') . ' Ft.' }}</h4>
                
                </td>
            </tr>
            
        @endif
            
        </tbody>
    </table>
    </div>
</div>
 </div>

           
<div class="col-lg-6">
<div class="border p-40 cart-totals ml-30 mb-50">
    <div class="d-flex align-items-end justify-content-between mb-30">
        <h4>Megrendelő adatai</h4>
       
    </div>
    <div class="divider-2 mb-30"></div>
    <div class="table-responsive order_table checkout">

        <form action="{{ route('cash.order')}}" method="post" >
            @csrf
          <div class="form-row" >
              
            
              <input type="hidden" name="name" value="{{ $data['shipping_name']}}">
          
              <input type="hidden" name="email" value="{{ $data['shipping_email']}}">
             
              <input type="hidden" name="phone" value="{{ $data['shipping_phone']}}">
            
              <input type="hidden" name="post_code" value="{{ $data['post_code']}}">
            
              <input type="hidden" name="address" value="{{ $data['shipping_address']}}">
           
              <input type="hidden" name="notes" value="{{ $data['notes']}}">

              <div  style="text-align: left;">
            <strong style="font-size: 20px;">Név:</strong>           
              <span style="font-size: 20px;">{{ $data['shipping_name']}}</span><br><br>
            <strong style="font-size: 20px;">Email cím:</strong>
              <span style="font-size: 20px;">{{ $data['shipping_email']}}</span><br><br>
            <strong style="font-size: 20px;">Telefon:</strong>                         
               <span style="font-size: 20px;">{{ $data['shipping_phone']}}</span><br><br> 
            <strong style="font-size: 20px;">Irányítószám:</strong>
             <span style="font-size: 20px;">{{ $data['post_code']}}</span><br><br>
             
            <strong style="font-size: 20px;">Cím:</strong>
              <span style="font-size: 20px;">{{ $data['shipping_address']}}"</span><br><br>
         
            <strong style="font-size: 20px;">Megjegyzés:</strong>
             <span style="font-size: 20px;">{{ $data['notes']}}</span><br><br>             
            </div>
              
          </div>
           <br>
          <br>

       <div class="col-lg-6">
          <span><a href="#">Elolvastam és elfogadom az adatkezelési tajákoztatót</a></span>
              <input type="checkbox" style="width:20px;" name="adatkezeles" value="elfogadva" required>
       </div>
      <div class="col-lg-6">
          <span><a href="#">Elolvastam és elfogadom a felhasznaloi tajákoztatót</a></span>
              <input type="checkbox" style="width:20px;" name="felhasznaloi" value="elfogadva" required>
       </div>
          <br>
          <br>
          <br>
          <button class="btn btn-success">Rendelés leadása</button>
          <br>
          <br>
          <br>
        </form>

    </div>
</div>

</div>

 @php
    }else{
    
 @endphp

  <div class="alert alert-danger" role="alert">
    Invalid rendelés. Valószínúleg már törölted a terméket a kosárból!               
  </div>
 @php
}
 @endphp


            </div>
        </div>




@endsection