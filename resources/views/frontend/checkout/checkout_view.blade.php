@extends('frontend.master_dashboard')
@section('main')
@section('title')
 Pénztár 
@endsection
 
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="" rel="nofollow"><i class="fi-rs-home mr-5"></i>Kezdőlap</a> 
                    <span></span> Pénztár
                </div>
            </div>
        </div>
        <div class="container mb-80 mt-50">
            <div class="row">
                <div class="col-lg-8 mb-40">
                    <h3 class="heading-2 mb-10">Pénztár</h3>
                    <div class="d-flex justify-content-between">
                        
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7">
    
    <div class="row">
        <h4 class="mb-30">Számlázási adatok</h4>
        <form method="post" action="{{ route('checkout.store')}}">
        	@csrf

            <div class="row">
                <div class="form-group col-lg-6">
                	<label for="shipping_name" style="color:#3BB77E; font-size: 20px;">Teljes név</label>
                    <input class="inputcolor" type="text" required="" name="shipping_name" placeholder="teljes név..." >
                    <!-- Ha regisztráltról van szó: blade komment: {{-- --}} tehát ki van kommentelve. -->
                     {{-- <input type="text" required="" name="shipping_name" placeholder="teljes név..." value="{{ Auth::user()->name}}">--}}
              
                </div>


                <div class="form-group col-lg-6">
                	<label for="shipping_email" style="color:#3BB77E; font-size: 20px;">Email cím</label>
                    <input class="inputcolor" type="email" required="" name="shipping_email" placeholder="email cím..." >
                    <!-- Ha regisztráltról van szó:-->
                   {{-- <input type="email" required="" name="shipping_email" placeholder="email cím..." value="{{ Auth::user()->email}}"> --}}
                    
                </div>
            </div>                          


         <div class="row shipping_calculator">
                   <div class="form-group col-lg-6">

                   		<label for="shipping_address" style="color:#3BB77E; font-size: 20px;">Cím</label>
                                    <input class="inputcolor" required="" type="text" name="shipping_address" placeholder="cím..." >
                                    <!-- Ha regisztráltról van szó:-->

                                    {{-- <input required="" type="text" name="shipping_address" placeholder="cím..."value="{{ Auth::user()->phone}}"> --}}
                                    
                                </div>


                                <div class="form-group col-lg-6">
                                		<label for="post_code" style="color:#3BB77E; font-size: 20px;">Irányítószám</label>
                                    <input class="inputcolor" required="" type="text" name="post_code" placeholder="irányítószám..." >
                                </div>



                            </div>

                             <div class="row shipping_calculator">
                                <div class="form-group col-lg-6">
                                    <div class="custom_select">
                                    	<!--
                                        <select class="form-control select-active">
                                            <option value="">Select an option...</option>
                                            <option value="AX">Aland Islands</option>
                                            <option value="AF">Afghanistan</option>
                                            <option value="AL">Albania</option>
                                            <option value="DZ">Algeria</option>
                                            <option value="AD">Andorra</option>
                                             
                                        </select>
                                        -->
                                    </div>
                                </div>
                            
                   <div class="form-group col-lg-6">
                   		<label for="shipping_phone" style="color:#3BB77E; font-size: 20px;">Telefonszám</label>
                        <input class="inputcolor" required="" type="text" name="shipping_phone" placeholder="Telefonszám..." >

                        <!-- Ha regisztráltról van szó:-->
                        {{-- <input required="" type="text" name="shipping_phone" placeholder="telefonszám..." value="{{ Auth::user()->phone}}"> --}}	
                                    
                   </div>




                            </div>


                              <div class="row shipping_calculator">
                                <div class="form-group col-lg-6">
                                    <div class="custom_select">
                                    	<!--  
                                        <select class="form-control select-active">
                                            <option value="">Select an option...</option>
                                            <option value="AX">Aland Islands</option>
                                            <option value="AF">Afghanistan</option>
                                            <option value="AL">Albania</option>
                                            <option value="DZ">Algeria</option>
                                            <option value="AD">Andorra</option>
                                             
                                        </select>
                                      -->

                                    </div>
                                </div>
              
                            </div>  
                            <div class="form-group mb-30">
                            		<label for="notes" style="color:#3BB77E; font-size: 20px;">Közlemény</label>
                                <textarea class="inputcolor" rows="5" placeholder="További információ" name="notes" ></textarea>
                            </div> 
                      
                    </div>
                </div>

                
<div class="col-lg-5">
<div class="border p-40 cart-totals ml-30 mb-50">
    <div class="d-flex align-items-end justify-content-between mb-30">
        <h4>Rendelés előnézet</h4>
        <h6 class="text-muted">Subtotal</h6>
    </div>
    <div class="divider-2 mb-30"></div>
    <div class="table-responsive order_table checkout">
        <table class="table no-border">
            <tbody>
                @foreach($carts as $item)
                <tr>
                    <td class="image product-thumbnail"><img src="{{ asset($item->options->image)}}" alt="#"></td>
                    <td>
                        <h6 class="w-160 mb-5">
                            <a href="#" class="text-heading">{{ $item->name}}</a></h6></span>
                        <div class="product-rate-cover">
           	<!-- Ide kell majd feltételvizsgálat, mert nem mindegyik terméknek van színe és mérete-->
                         <strong>Szín :{{ $item->options->color}} </strong>
                         <strong>Méret : {{ $item->options->size}}</strong>
                             
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




 <table class="table no-border">
        <tbody>
        	<!-- Ha meg van adva érvényes kupon:-->
        	@if(Session::has('coupon'))

        	            <tr>
                <td class="cart_total_label">
                    <h6 class="text-muted">Részösszeg</h6>
                </td>
                <td class="cart_total_amount">
                    <h4 class="text-brand text-end">{{ $cartTotal }} Ft.</h4>
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
        	<!-- Ha nincs megadva kupon:-->
               <tr>
                <td class="cart_total_label">
                    <h6 class="text-muted">Fizetendő</h6>
                </td>
                <td class="cart_total_amount">
        	<!-- Cartcontroller: checkoutCreate funkcióból jön a cartTotal változó:-->
                    <h4 class="text-brand text-end">{{  number_format($cartTotal, 0, ',', ' ') . ' Ft.' }}</h4>
                </td>
            </tr>

        	@endif
    
        </tbody>
    </table>

    </div>
</div>
                    <div class="payment ml-30">
                        <h4 class="mb-30">Válassz fizetési módot!</h4>
                        <div class="payment_option">
                            <div class="custome-radio">
                                <input class="form-check-input" value="stripe" required="" type="radio" name="payment_option" id="exampleRadios3" checked="">
                                <label class="form-check-label" for="exampleRadios3" data-bs-toggle="collapse" data-target="#bankTranfer" aria-controls="bankTranfer">Fizetés Stripe használatával</label>
                            </div>
                            <div class="custome-radio">
                                <input class="form-check-input" value="cash" required="" type="radio" name="payment_option" id="exampleRadios4" checked="">
                                <label class="form-check-label" for="exampleRadios4" data-bs-toggle="collapse" data-target="#checkPayment" aria-controls="checkPayment">Utánvétes fizetés</label>
                            </div>
                            
                            	<!-- 
                            
                            <div class="custome-radio">
                                <input class="form-check-input" value="card" required="" type="radio" name="payment_option" id="exampleRadios5" checked="">
                                <label class="form-check-label" for="exampleRadios5" data-bs-toggle="collapse" data-target="#paypal" aria-controls="paypal">Online Getway</label>
                            </div>
                        </div>
                        <div class="payment-logo d-flex">
                            <img class="mr-15" src=" {{ asset('frontend/assets/imgs/theme/icons/payment-paypal.svg') }}" alt="">
                            <img class="mr-15" src=" {{ asset('frontend/assets/imgs/theme/icons/payment-visa.svg') }}" alt="">
                            <img class="mr-15" src=" {{ asset('frontend/assets/imgs/theme/icons/payment-master.svg') }}" alt="">
                            <img src="assets/imgs/theme/icons/payment-zapper.svg" alt="">
                        </div>
                        -->
                        
                        
                        <button type="submit" class="btn btn-fill-out btn-block mt-30">Tovább<i class="fi-rs-sign-out ml-15"></i></button>
                    </div>
                </div>
            </div>
        </div>
  </form>


@endsection