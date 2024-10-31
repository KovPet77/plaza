@extends('frontend.master_dashboard')
@section('main')
@section('title')
Üzlet
@endsection
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-header mt-30 mb-50">
            <div class="container">
                <div class="archive-header">
                    <div class="row align-items-center">
                        <div class="col-xl-3">
                            <h5 class="mb-15">Üzlet</h5>
                            <div class="breadcrumb">
                                <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Kezdőlap</a>
                                 <span></span> {{ $breadcat->category_name}}
                                  <span></span> @foreach($subcat as $subcatName)
                                {{ $subcatName }}
                                @if (!$loop->last) <!-- Ellenőrzi, hogy ez az utolsó elem-e a kollekcióban -->
                                    <span></span>
                                @endif
                                @endforeach
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
<form method="post" action="{{ route('shop.filter.select') }}" id="sort-form">
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
            <!--
            <input type="hidden" name="alkategoria_id" value="{{-- $alkategoria_id --}}">
            <input type="hidden" name="alkategoria_slug" value="{{-- $alkategoria_slug --}}">    
                  -->
            </div>       
        </div>
    </div>
</form>
 </div>


<!--

<div class="row product-grid">

    <h3>Kategóriák</h3>
    @foreach($categories as $category)
    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
    <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
    <div class="product-img-action-wrap">
 


</div>
<div class="product-content-wrap">
    <div class="product-category">
        <a href=""><img src="{{asset($category->category_image)}}" style="width:60%; height:auto;" /></a>
    </div>
  

    <div>                             


</div>
<div class="product-card-bottom">

            </div>
        </div>
    </div>
</div>
<br><br><br>

@endforeach
</div>
-->




<div class="row product-grid">

@foreach($products as $product)
<div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
<div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
<div class="product-img-action-wrap">
    <div class="product-img product-img-zoom">
        <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug)}}">
            <img class="default-img" src="{{asset($product->product_thumbnail)}}" alt="" />
       
        </a>
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
    <div class="product-category">
        <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug)}}">{{ $product['category']['category_name']}}</a>
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
  <span class="font-small text-muted">By <a href="vendor-details-1.html">Tulajdonos</a></span>
@else
    <span class="font-small text-muted">By <a href="vendor-details-1.html">{{$product['vendor']['name']}}</a></span>
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

    <!--

    <div class="add-cart">
        <a class="add" href="{{ url('product/details/'.$product->id.'/'.$product->product_slug)}}"><i class="fi-rs-shopping-cart mr-5"></i>Tovább </a>
    </div>
-->

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

<div class="sidebar-widget price_range range mb-30">

<form method="post" action="{{ route('shop.page') }}">

@csrf

<h5 class="section-title style-1 mb-30">Szűrés ár szerint</h5>

<input type="hidden" name="kategoria_id" value="{{ $product->category_id }}">


<div class="price-filter">
<div class="price-filter-inner">
<div id="slider-range" class="price-filter-range" data-min="0" data-max="1000000 "></div>
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




        <div class="list-group">
            <!--
            <div class="list-group-item mb-10 mt-10">

                @if(!empty($_GET['category']))
                @php
                $filterCat = explode(',', $_GET['category']);
                @endphp
                @endif

                <label class="fw-900">Kategóriák</label>
                @foreach($categories as $category)

                @php
                $products = App\Models\Product::where('category_id', $category->id)->get();
                @endphp

                <div class="custome-checkbox">
                    <input class="form-check-input" type="checkbox" name="category[]" id="exampleCheckbox{{ $category->id }}" value="{{ $category->category_slug }}" @if(!empty($filterCat) && in_array($category->category_slug,$filterCat)) checked @endif onchange="this.form.submit()" />
                    <label class="form-check-label" for="exampleCheckbox{{ $category->id }}"><span>{{ $category->category_name }} ({{ count($products) }})</span></label>
                    <br />  
                    
                </div>
                @endforeach


                @if(!empty($_GET['brand']))
                @php
                $filterBrand = explode(',', $_GET['brand']);
                @endphp
                @endif
                <label class="fw-900 mt-15">Márkák</label>
                @foreach($brands as $brand)
               <div class="custome-checkbox">
                    <input class="form-check-input" type="checkbox" name="brand[]" id="exampleBrand{{ $brand->id }}" value="{{ $brand->brand_slug }}" @if(!empty($filterBrand) && in_array($brand->brand_slug,$filterBrand)) checked @endif onchange="this.form.submit()" />
                    <label class="form-check-label" for="exampleBrand{{ $brand->id }}"><span>{{ $brand->brand_name }} </span></label>
                    <br />  
                    
                </div>
                @endforeach
            </div>

            -->


        </div>        
    </div>
      </form>


 <h5 class="section-title style-1 mb-30">Kategóriák</h5>
<div class="vertical-menu">
    @php
    $categories = App\Models\Category::orderBy('category_name', 'ASC')->limit(5)->get();
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
        <li><a href="{{ url('product/category/'.$category->id.'/'.$category->category_slug)}}">{{ $subcategory->subcategory_name }}</a></li>
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