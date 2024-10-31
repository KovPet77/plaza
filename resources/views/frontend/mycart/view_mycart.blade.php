@extends('frontend.master_dashboard')
@section('main')
@section('title')
 Kosár 
@endsection

        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Kezdőlap</a>
                  
                    <span></span>Kosár
                </div>
            </div>
        </div>
        <div class="container mb-80 mt-50">
            <div class="row">
                <div class="col-lg-8 mb-40">
                    <h4 class="heading-2 mb-10">Kosár</h4>
                    <div class="d-flex justify-content-between">
                        
    
                    </div>
                </div>
            </div>

            @if(Cart::count() > 0)
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive shopping-summery">
                        <table class="table table-wishlist">
                            <thead>
                                <tr class="main-heading">
                                    <th class="custome-checkbox start pl-30">
                                        
                                    </th>
                                    <th scope="col" colspan="2">Termék</th>
                                    <th scope="col">Egységár</th>
                                    <th scope="col">Szín</th>
                                    <th scope="col">Méret</th>
                                    <th scope="col">Darabszám</th>
                                    <th scope="col">Részösszeg</th>
                                    <th scope="col" class="end">Törlés</th>
                                </tr>
                            </thead>
                            <tbody id="CartPage">



                            </tbody>
                        </table>
                    </div>
                   
            <div class="row mt-50">

                <!-- Ha be van állítva a session-ben a kupon, tehát érvényest kódott adott meg, akkor nem
                mutatjuk a kupon megadó felületet, hogy még véletlenül se tudja megadni mégegyszer.
                Ha még nincs beálítva a kupon a sessioben akkor mutatjuk a felületet
                -->
              <div class="col-lg-5">
                @if(Session::has('coupon'))

                @else

                <div class="p-40" id="couponField">
                    <h4 class="mb-10">Kupon</h4>
                    <p class="mb-30"><span class="font-lg text-muted">Rendelkezel kupon kóddal?</p>
                    <form action="#">
                        <div class="d-flex justify-content-between">
                            <input class="font-medium mr-15 coupon inputcolor" id="coupon_name" placeholder="Kupon kód megadása">
                            <a class="btn btn-success" type="submit" onclick="applyCoupon()"><i class="fi-rs-label mr-10"></i>Alkalmaz</a>
                        </div>
                    </form>
                </div>
           
                @endif
                </div>

                        <div class="col-lg-7">
                             <div class="divider-2 mb-30"></div>

                            <div class="border p-md-4 cart-totals ml-30">
                        <div class="table-responsive">
                            <table class="table no-border">
                                <tbody id="couponCalField">
                      
                                </tbody>
                            </table>
                        </div>
                        <a href="{{ route('penztar') }}" class="btn mb-20 w-100">Tovább a pénztárhoz<i class="fi-rs-sign-out ml-15"></i></a>
                    </div>
                  </div>

               @else
              <div class="row">
                <div class="col-lg-8 mb-40">
                   <div class="alert alert-danger" role="alert">
                     A kosarad üres!
                    </div>
                    <div class="d-flex justify-content-between">
                     <a href="{{ url('/')}}">Vissza a termékekhez</a>
    
                    </div>
                </div>
            </div>
               @endif                    
                    </div>
                </div>
                 
            </div>
        </div>


@endsection