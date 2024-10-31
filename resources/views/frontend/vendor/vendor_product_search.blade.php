@extends('frontend.master_dashboard')
@section('main')
@section('title')

@endsection
            <br><br>
        <div class="container mb-30">
            <div class="row flex-row-reverse">
                <div class="col-lg-4-5">
                    <div class="shop-product-fillter">
                        <div class="totall-product">
                            <p><strong class="text-brand"></strong></p>
                        </div>



     <form class="filter-form" method="GET" action="{{ route('vendor.termek.kereses') }}">
            <div class="search-bar">
                <input  type="text" name="search" placeholder="Termék keresése ebben az üzletben..." style="height:40px;">
                <button  type="submit"style="width: 300px; height:40px; padding:0;">Keresés</button>
            </div>
        </form>



@foreach($products as $product)

@endforeach

    
<form method="GET" action="{{ route('elado.termek.rendezes') }}" id="sort-form">
    @csrf 
    <div class="sort-by-product-area">
        <div class="sort-by-cover mr-10">
            <div class="sort-by-product-wrap">      
                <select id="sort-select" name="rendezes">
                    <option value="">Rendezés</option>
                    <option value="arszerint-novekvo">Ár szerint növekvő</option>
                    <option value="arszerint-csokkeno">Ár szerint csökkenő</option>
                    <option value="diszkont">Akciós termékek</option>
                </select>                
               
                @if(!empty($item))
                <input type="hidden" name="searchQuery" value="{{ $item }}">
                @endif     


                @if(!empty($product))
                <input type="hidden" name="subcategory_slug" value="{{ $product->subcategory_slug }}">
                @endif               
                
            </div>
        </div>
    </div>
</form>

</div>



<div class="row product-grid">
    @if(empty($product->product_name))

      <div class="alert alert-danger" role="alert">
      Jelenleg nincs ilyen termék
     </div>
    @endif


@foreach($products as $product)

      


<div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
<div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
<div class="product-img-action-wrap">
<div class="product-img product-img-zoom">
<a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug)}}">
    <img class="default-img" src="{{asset($product->product_thumbnail)}}" alt="" />

</a>
<p><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug)}}">{{ $product->product_name}}</a></p>
</div>
<div class="product-action-1">
<a  aria-label="Kívánság listára" class="action-btn" id="{{ $product->id }}" onclick="addToWishList(this.id)" ><i class="fi-rs-heart"></i></a>
<a aria-label="Összehasonlítás" class="action-btn" id="{{ $product->id }}" onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>
<a aria-label="Gyors nézet" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{ $product->id}}" onclick="productView(this.id)"><i class="fi-rs-eye"></i></a>   
</div>

@php

$amount = $product->selling_price -  $product->discount_price;
$discount = ($amount/$product->selling_price) * 100;
@endphp
<div class="product-badges product-badges-position product-badges-mrg">

@if($product->discount_price == NULL)

<span class="new">Új</span>
@else
<span class="hot">{{ round($discount)}} %</span>
@endif

</div>
</div>
<div class="product-content-wrap">
<div>


</div>
<div class="product-card-bottom">

@if($product->discount_price == NULL)
  <div class="product-price">
    <span>{{ number_format($product->selling_price, 0, ',', ' ') . ' Ft.' }}</span>
  
</div>
@else
<div class="product-price">
    <span>{{ number_format($product->discount_price, 0, ',', ' ') . ' Ft.' }}</span>
    <span class="old-price">{{ number_format($product->selling_price, 0, ',', ' ') . ' Ft.' }}</span>
</div>
@endif


<div class="add-cart">
   
</div>
</div>
</div>
</div>
</div>
<!--end product card-->

@endforeach       
</div>
          
                    
                                    
<div class="pagination-area mt-20 mb-20">
{{ $products->links('vendor.pagination.custom')}}
</div>    
</div>

<div class="col-lg-1-5 primary-sidebar sticky-sidebar">
<div class="sidebar-widget widget-store-info mb-30 bg-3 border-0">
    <div class="vendor-logo mb-30">
        <img src="{{ (!empty($vendor->photo)) ? url('upload/vendor_images/'.$vendor->photo) : url('upload/no_image.jpg') }}" alt="" />
    </div>
    <div class="vendor-info">
        <div class="product-category">
            <span class="text-muted">{{ $vendor->vendor_join}} óta</span>
        </div>
        <h4 class="mb-5"><a href="" class="text-heading">{{ $vendor->name}}</a></h4>
        <div class="product-rate-cover mb-15">
            <div class="product-rate d-inline-block">
                <div class="product-rating" style="width: 90%"></div>
            </div>
            <span class="font-small ml-5 text-muted"> (4.0)</span>
        </div>
        <div class="vendor-des mb-30">
            <p class="font-sm text-heading">{{ $vendor->vendor_short_info}}</p>
        </div>
        <div class="follow-social mb-20">
            <h6 class="mb-15">Kövess</h6>
            <ul class="social-network">
                <li class="hover-up">
                    <a href="#">
                        <img src="{{ asset('frontend/assets/imgs/theme/icons/social-tw.svg') }} " alt="" />
                    </a>
                </li>
                <li class="hover-up">
                    <a href="#">
                        <img src="{{ asset('frontend/assets/imgs/theme/icons/social-fb.svg') }} " alt="" />
                    </a>
                </li>
                <li class="hover-up">
                    <a href="#">
                        <img src="{{ asset('frontend/assets/imgs/theme/icons/social-insta.svg') }} " alt="" />
                    </a>
                </li>
                <li class="hover-up">
                    <a href="#">
                        <img src="{{ asset('frontend/assets/imgs/theme/icons/social-pin.svg') }} " alt="" />
                    </a>
                </li>
            </ul>
        </div>
        <div class="vendor-info">
            <ul class="font-sm mb-20">
                <li><img class="mr-5" src="assets/imgs/theme/icons/icon-location.svg" alt="" /><strong>Cím: </strong> <span>{{ $vendor->address}}</span></li>
                <li><img class="mr-5" src="assets/imgs/theme/icons/icon-contact.svg" alt="" /><strong>Telefon:</strong><span>{{ $vendor->phone}}</span></li>
            </ul>
            <a href="" class="btn btn-xs">Eladó elérhetősége<i class="fi-rs-arrow-small-right"></i></a>
        </div>
    </div>
</div>

</div>





            </div>
        </div>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const sortForm = document.getElementById("sort-form");
    const sortSelect = document.getElementById("sort-select");

    if (sortForm && sortSelect) {
        sortSelect.addEventListener("change", function () {
            sortForm.submit();
        });
    }
});
</script>
@endsection