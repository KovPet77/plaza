@extends('frontend.master_dashboard')
@section('main')
@section('title')
{{ $breadcat->category_name}} Kategóriák
@endsection
<div class="page-header mt-30 mb-50">
            <div class="container">
                <div class="archive-header">
                    <div class="row align-items-center">
                        <div class="col-xl-3">
                            <h5 class="mb-15">{{ $breadcat->category_name}}</h5>
                            <div class="breadcrumb">
                                <a href="" rel="nofollow"><i class="fi-rs-home mr-5"></i>Kezdőlap</a>
<!-- 
                                <span></span> {{ $breadcat->category_name}}
                                <span></span> @foreach($subcat as $subcatName)
                                {{ $subcatName }}
                                @if (!$loop->last) <!-- Ellenőrzi, hogy ez az utolsó elem-e a kollekcióban -->
                                <!--
                                    <span></span>
                                @endif
                                @endforeach
-->

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
<!--

                            <p><strong class="text-brand">{{ count($products)}}</strong> termék található ebben a kategórában</p>
-->                                    
                        </div>


@foreach($products as $product)

@endforeach
@foreach($subcat as $sub)

@endforeach

<!--
<form method="get" action="{{ route('shop.filter.select.sub') }}" id="sort-form">
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
             
                <input type="hidden" name="category_id" value="{{ $product->category_id }}">
          
            </div>
       
        </div>
    </div>
</form>
-->
</div>
<h5>Alkategóriák:</h5>
 <br>
<div class="row product-grid">
       @foreach ($subcategories as $subcategory)
<div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                <div class="card-2 bg-9 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                    <figure class="img-hover-scale overflow-hidden">
                        <a href="{{ url('product/subcategory/'.$subcategory->id.'/'.$subcategory->subcategory_slug) }}"><img src="{{ asset($subcategory->subcategory_image) }}" alt="{{ $subcategory->subcategory_name }}"  style="width:100%; height:auto;" /></a>
                    </figure>
                    <h6>
                        <a href="{{ url('product/subcategory/'.$subcategory->id.'/'.$subcategory->subcategory_slug) }}">
                            {{ $subcategory->subcategory_name }}
                        </a>
                    </h6>
                </div>

<div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">


    </div>
</div>               
@endforeach

       
 </div>
      
                    
               




































                    
</div>
<div class="col-lg-1-5 primary-sidebar sticky-sidebar">

    <!--
        <form method="post" action="{{ route('shop.page') }}">
  {{-- $product->category_id --}}
   <input type="hidden" name="kategoria_id" value="{{ $product->category_id }}">
            @csrf
        <h5 class="section-title style-1 mb-30">Szűrés ár szerint</h5>
        <div class="price-filter">
            <div class="price-filter-inner">
            <div id="slider-range" class="price-filter-range" data-min="0" data-max="600000 "></div>
            <br><br>
            <input type="text" id="amount" value="1000 - 1 000 000" readonly>

            <div class="slider-container">
                <div id="range-slider" class="range-slider"></div>
                <input type="hidden" id="price_range" name="price_range" value="">
                <div class="slider-label">              
                  
                </div>
            </div>
               <br>
                <button type="submit" class="btn btn-sm btn-default"><i class="fi-rs-filter mr-5"></i>Szűrés</button>
            </div>
        </div>
    </form>
-->
<br><br>





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



<!--
@php
$categories = App\Models\Category::orderBy('category_name','ASC')->limit(5)->get();       
@endphp


@foreach($categories as $category)
<li>
226-os lecke 3:40
<a href="{{ url('product/category/'.$category->id.'/'.$category->category_slug)}}">{{$category->category_name}} <i class="fi-rs-angle-down"></i></a>

@php
$subcategories = App\Models\SubCategory::where('category_id', $category->id)->orderBy('subcategory_name','ASC')->get();       
@endphp

<ul class="sub-menu">
@foreach($subcategories as $subcategory)
<li><a href="{{ url('product/subcategory/'.$subcategory->id.'/'.$subcategory->subcategory_slug)}}">{{ $subcategory->subcategory_name}}</a></li>           
@endforeach
</ul>
</li>
@endforeach


<div class="sidebar-widget widget-category-2 mb-30">
<h5 class="section-title style-1 mb-30">Kategóriák</h5>
<ul>
@foreach($categories as $category)

@php

$products = App\Models\Product::where('category_id', $category->id)->get();
@endphp
<li>
<a href="{{ url('product/category/'.$category->id.'/'.$category->category_slug)}}"> <img src="{{ asset($category->category_image)}}" alt="" />{{ $category->category_name}}</a><span class="count">{{ count($products)}}</span>
</li>
@endforeach

</ul>
</div>
-->

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
    const sliderRange = document.getElementById("slider-range");
    const amount = document.getElementById("amount");
    const priceRangeInput = document.getElementById("price_range");

    if (sliderRange) {
        const maxPrice = parseInt(sliderRange.getAttribute("data-max"));
        const minPrice = parseInt(sliderRange.getAttribute("data-min"));

        // Módosított léptékek 500-asával
        const step = 500;
        const range = {
            min: minPrice,
            max: maxPrice,
        };

        let priceRange = minPrice + "-" + maxPrice;

        let price = priceRange.split("-");

        noUiSlider.create(sliderRange, {
            start: price,
            connect: true,
            range: range,
            step: step, // Hozzáadva a lépték
            format: {
                to: function (value) {
                    return  + value;
                },
                from: function (value) {
                    return value.replace("", "").replace(",", "");
                },
            },
        });

        sliderRange.noUiSlider.on("update", function (values, handle) {
            amount.value = values.join(" - ");
            priceRangeInput.value = values.join("-");
        });
    }
});
</script>
<script>
// Az "input" eseményfigyelőt hozzáadjuk mindkét input mezőhöz
document.getElementById("manualminimum").addEventListener("input", function() {
    this.value = this.value.replace(/\D/g, ''); // Csak számok engedélyezése
});

document.getElementById("manualmaximum").addEventListener("input", function() {
    this.value = this.value.replace(/\D/g, ''); // Csak számok engedélyezése
});
</script>



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