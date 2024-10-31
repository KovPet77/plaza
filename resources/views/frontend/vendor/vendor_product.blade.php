@extends('frontend.master_dashboard')
@section('main')
@section('title')
Üzlet adatai
@endsection
<div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Kezdőlap</a>
                  <span></span> Eladó termékei
                </div>
            </div>
        </div>
        <div class="container mb-30">
            <div class="archive-header-2 text-center pt-80 pb-50">
                <!--
                <h1 class="display-2 mb-50">{{ $vendor->name}} üzlete</h1>
                -->
            </div>
    <div class="row flex-row-reverse">
        <div class="col-lg-4-5">
            <div class="shop-product-fillter">
                <div class="totall-product">
               
                </div> 



     <form class="filter-form" method="GET" action="{{ route('vendor.termek.kereses') }}">
            <div class="search-bar">
                <input  type="text" name="search" placeholder="Termék keresése ebben az üzletben..." style="height:40px;">
                <button  type="submit"style="width: 300px; height:40px; padding:0;">Keresés</button>
            </div>
        </form>



                @foreach($products as $product)

                @endforeach


<form method="get" action="{{ route('elado.termek.rendezes') }}" id="sort-form">
    @csrf
    <input type="hidden" name="kategoria_id" value="{{ $product->category_id }}">
    <div class="sort-by-product-area">
        <div class="sort-by-cover mr-10">
            <div class="sort-by-product-wrap">      
                <select id="sort-select" name="rendezes">
                    <option value="">Rendezés</option>
                    <option value="arszerint-novekvo">Ár szerint növekvő</option>
                    <option value="arszerint-csokkeno">Ár szerint csökkenő</option>
                    <option value="diszkont">Akciós termékek</option>
                </select>
                <input type="hidden" name="subcategory_slug" value="{{ $product->subcategory_slug }}">
                <!--
                <input type="hidden" name="subcategory_slug" value="{{-- $breadsubcat->subcategory_slug --}}">
                -->
                <input type="hidden" name="category_id" value="{{ $product->category_id }}">
            </div>
        </div>
    </div>
</form>         
            </div>





<div class="row product-grid">
@foreach($products as $product)
<div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
<div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
<div class="product-img-action-wrap">
<div class="product-img product-img-zoom">
<a href="{{ url('/product/vendor/details/' . $vendorId . '/' . $product->product_slug) }}">

    <img class="default-img" src="{{asset($product->product_thumbnail)}}" alt="pomazplaza" />

</a>
</div>

 <!--
<div class="product-action-1">
<a  aria-label="Kívánság listára" class="action-btn" id="{{ $product->id }}" onclick="addToWishList(this.id)" ><i class="fi-rs-heart"></i></a>
<a aria-label="Összehasonlítás" class="action-btn" id="{{ $product->id }}" onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>
<a aria-label="Gyorsnézet" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{ $product->id}}" onclick="productView(this.id)"><i class="fi-rs-eye"></i></a>
</div>
 -->

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
<div class="product-category">
    <a href="{{ url('/product/details/'.$product->vendorId.'/'.$product->product_slug)}}">{{ $product['category']['category_name']}}</a>

</div>
{{ $product->vendorId }}
<h2><a href="{{ url('/product/vendor/details/'.$product['vendor']['id'].'/'.$product->product_slug)}}">{{ $product->product_name }}</a></h2>
<div class="product-rate-cover">
    <div class="product-rate d-inline-block">
        <div class="product-rating" style="width: 90%"></div>
    </div>
    <span class="font-small ml-5 text-muted"> (4.0)</span>
</div>
<div>

@if($product->vendor_id == NULL)
  <span class="font-small text-muted">Eladó: <a href="">Tulajdonos</a></span>
@else

    <span class="font-small text-muted">
        Eladó:<a href="{{ url('/pomaz-plaza-' . $product['vendor']['vendor_slug']) }}">{{$product['vendor']['name']}}</a>
    </span> 
    
  
@endif                            


</div>
<div class="product-card-bottom">

@if($product->discount_price == NULL)
  <div class="product-price">
    <span>{{ number_format($product->selling_price, 0, ',', ' ') }} Ft.</span>
  
</div>
@else
<div class="product-price">
    <span>{{ number_format( $product->discount_price, 0, ',', ' ') }} Ft.</span>
    <span class="old-price">{{ number_format($product->selling_price, 0, ',', ' ') }} Ft.</span>
</div>
@endif                         

</div>
</div>
</div>
</div>          

@endforeach        
</div>                

<div class="pagination-area mt-20 mb-20">
         {{ $products->links('vendor.pagination.custom')}}
</div>                     
                 
</div>
<div class="col-lg-1-5 primary-sidebar sticky-sidebar">
<div class="sidebar-widget widget-store-info mb-30 bg-3 border-0">
    <div class="vendor-logo mb-30">
        <img src="{{ (!empty($vendor->photo)) ? url('upload/vendor_images/'.$vendor->photo) : url('upload/no_image.jpg') }}" alt="pomazplaza" />
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
                        <img src="{{ asset('frontend/assets/imgs/theme/icons/social-tw.svg') }} " alt="pomazplaza" />
                    </a>
                </li>
                <li class="hover-up">
                    <a href="#">
                        <img src="{{ asset('frontend/assets/imgs/theme/icons/social-fb.svg') }} " alt="pomazplaza" />
                    </a>
                </li>
                <li class="hover-up">
                    <a href="#">
                        <img src="{{ asset('frontend/assets/imgs/theme/icons/social-insta.svg') }} " alt="pomazplaza" />
                    </a>
                </li>
                <li class="hover-up">
                    <a href="#">
                        <img src="{{ asset('frontend/assets/imgs/theme/icons/social-pin.svg') }} " alt="pomazplaza" />
                    </a>
                </li>
            </ul>
        </div>
        <div class="vendor-info">
            <ul class="font-sm mb-20">
                <li><img class="mr-5" src="{{ asset('frontend/assets/imgs/theme/icons/icon-location.svg') }}" alt="pomazplaza" /><strong>Cím: </strong> <span>{{ $vendor->address}}</span></li>
                <li><img class="mr-5" src="{{ asset('frontend/assets/imgs/theme/icons/icon-contact.svg') }}" alt="pomazplaza" /><strong>Telefon:</strong><span>{{ $vendor->phone}}</span></li>
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