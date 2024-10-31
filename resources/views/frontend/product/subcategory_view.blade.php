@extends('frontend.master_dashboard')
@section('main')
@section('title')
 {{ $breadsubcat->subcategory_name}} > {{ $breadsubcat->subcategory_name}}
@endsection
<div class="page-header mt-30 mb-50">
            <div class="container">
                <div class="archive-header">
                    <div class="row align-items-center">
                        <div class="col-xl-3">
                            <h5 class="mb-15">{{ $breadsubcat->subcategory_name}}</h5>
                            <div class="breadcrumb">
                                <a href="{{ route('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Kezdőlap</a>
                                <span></span> {{ $breadsubcat->category->category_name}}
                                <span></span> {{ $breadsubcat->subcategory_name}}
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
<div class="container mb-30">
<div class="row flex-row-reverse">
<div class="col-lg-4-5">
    <div class="shop-product-fillter">
        <div class="totall-product">
           
        </div>
       @foreach($products as $product)
        @endforeach


        @foreach($breadsubcat as $sub)
        @endforeach
        <form class="filter-form" method="GET" action="{{ route('mobil.kereses') }}">
            <div class="search-bar">
                  <input  type="text" name="search" placeholder="Termék keresése" style="height:40px;">
                <button  type="submit"style="width: 300px; height:40px; padding:0;">Keresés</button>
            </div>
       
            <input type="hidden" name="product_subcategory_slug" value="{{ $product->subcategory_slug }}">
        </form>





 <!--Selectes keresés -->
        <form method="get" action="{{ route('shop.filter.select.sub') }}" id="sort-form" class="filter-form">
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
                        <input type="hidden" name="subcategory_name" value="{{ $breadsubcat->subcategory_name }}">
                        <input type="hidden" name="subcategory_slug" value="{{ $breadsubcat->subcategory_slug }}">
                        <input type="hidden" name="category_id" value="{{ $product->category_id }}">
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

<a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug)}}">
    <img class="image" src="{{asset($product->product_thumbnail)}}" alt="" />

</a>

  <!-- 
<div class="product-action-1">
<a  aria-label="Kívánság listára" class="action-btn" id="{{ $product->id }}" onclick="addToWishList(this.id)" ><i class="fi-rs-heart"></i></a>
<a aria-label="Összehasonlítás" class="action-btn" id="{{ $product->id }}" onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>

<a aria-label="Gyors nézet" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{ $product->id}}" onclick="productView(this.id)"><i class="fi-rs-eye"></i></a> 

  
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
<a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug)}}">{{ $product['subcategory']['subcategory_name']}}</a>
</div>
<h2><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug)}}">{{ $product->product_name }}</a></h2>
<div class="product-rate-cover">
<div class="product-rate d-inline-block">
    <div class="product-rating" style="width: 90%"></div>
</div>
<span class="font-small ml-5 text-muted"> (4.0)</span>
</div>
<div>

@if($product->vendor_id == NULL)
  <span class="font-small text-muted">Eladó <a href=""> Tulajdonos </a></span>
@else
    <span class="font-small text-muted">Eladó <a  href="{{ url('pomaz-plaza-' . $product['vendor']['vendor_slug']) }}">{{$product['vendor']['name']}}</a></span>
  
@endif



</div>
<div class="product-card-bottom">

@if($product->discount_price == NULL)
  <div class="product-price">
    <span>{{ number_format($product->selling_price, 0, ',', ' ') }} Ft.</span>
  
</div>
@else
<div class="product-price">
    <span>{{ number_format($product->discount_price, 0, ',', ' ') }} Ft.</span>
    <span class="old-price">{{ number_format($product->selling_price, 0, ',', ' ') }} Ft.</span>
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


<!--

<div class="sidebar-widget widget-category-2 mb-30">
<h5 class="section-title style-1 mb-30">Kategóriák</h5>
<ul>
	@foreach($categories as $category)


	@php

	$products = App\Models\Product::where('category_id', $category->id)->get();
	@endphp
    <li>
        <a href="shop-grid-right.html"> <img src="{{ asset($category->category_image)}}" alt="" />{{ $category->category_name}}</a><span class="count">{{ count($products)}}</span>
    </li>
	@endforeach
    
</ul>
</div>
-->



<h5 class="section-title style-1 mb-30">Kategóriák</h5>
<div class="vertical-menu">
    @php
    $categories = App\Models\Category::orderBy('category_name', 'ASC')->limit(6)->get();
    @endphp

    @foreach($categories as $category)
    <a class="parent-menu" href="{{ url('product/category/'.$category->id.'/'.$category->category_slug)}}">
        {{ $category->category_name }} <i class="fi-rs-angle-small-down"></i>
    </a>

    @php
    $subcategories = App\Models\SubCategory::where('category_id', $category->id)->orderBy('subcategory_name', 'ASC')->get();
    @endphp

    <ul class="submenu">
        @foreach($subcategories as $subcategory)
        <li>

       <!--Ez volt itt előtte
            <a href="{{ url('product/category/'.$category->id.'/'.$category->category_slug)}}">{{ $subcategory->subcategory_name }}</a>
        -->
            <a href="{{ url('product/subcategory/'.$subcategory->id.'/'.$subcategory->subcategory_slug) }}">{{ $subcategory->subcategory_name }}</a>
        </li>
        @endforeach
    </ul>
    @endforeach
</div>
 
        <!-- Product sidebar Widget -->
        <div class="sidebar-widget product-sidebar mb-30 p-30 bg-grey border-radius-10">
            <h5 class="section-title style-1 mb-30">Új termékek</h5>
            

            @foreach($newProduct as $product)
            <div class="single-post clearfix">
                <div class="image">
                    <img src="{{asset($product->product_thumbnail)}}" alt="#" />
                </div>
                <div class="content pt-10">
                    <p><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug)}}">{{ $product->product_name}}</a></p>

                     @if($product->discount_price == NULL)
                     <p class="price mb-0 mt-5">{{ number_format($product->selling_price, 0, ',', ' ') }} Ft.</p>

                     @else
                    <p class="price mb-0 mt-5">{{ number_format($product->discount_price, 0, ',', ' ') }} Ft.</p>

                     @endif
                    <div class="product-rate">
                        <div class="product-rating" style="width: 90%"></div>
                    </div>
                </div>
            </div>
            @endforeach



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