@extends('frontend.master_dashboard')
@section('main')
@section('title')
Szolgáltatók
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
                                <span></span> Üzlet
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
                            <p><strong class="text-brand">{{ count($products)}}</strong> termék található ebben a kategórában</p>
                        </div>
                        <div class="sort-by-product-area">
                            <div class="sort-by-cover mr-10">
                                <div class="sort-by-product-wrap">

<!--
                                    <div class="sort-by">
                                        <span><i class="fi-rs-apps"></i>Show:</span>
                                    </div>
                                    <div class="sort-by-dropdown-wrap">
                                        <span> 50 <i class="fi-rs-angle-small-down"></i></span>
                                    </div>
-->

                                </div>
                                <div class="sort-by-dropdown">
                                    <ul>
                                        <li><a class="active" href="#">50</a></li>
                                        <li><a href="#">100</a></li>
                                        <li><a href="#">150</a></li>
                                        <li><a href="#">200</a></li>
                                        <li><a href="#">All</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="sort-by-cover">
                                <div class="sort-by-product-wrap">
<!--
                                    <div class="sort-by">
                                        <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                                    </div>
                                    <div class="sort-by-dropdown-wrap">
                                        <span> Featured <i class="fi-rs-angle-small-down"></i></span>
                                    </div>
-->

                                </div>
                                <div class="sort-by-dropdown">
                                    <ul>
                                        <li><a class="active" href="#">Featured</a></li>
                                        <li><a href="#">Price: Low to High</a></li>
                                        <li><a href="#">Price: High to Low</a></li>
                                        <li><a href="#">Release Date</a></li>
                                        <li><a href="#">Avg. Rating</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row product-grid">



                   @foreach($advertisers as $advertiser)
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
            <a aria-label="Compare" class="action-btn" id="{{ $product->id }}" onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>
            <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{ $product->id}}" onclick="productView(this.id)"><i class="fi-rs-eye"></i></a>
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

        <form method="post" action="{{ route('shop.filter') }}">

            @csrf

        <h5 class="section-title style-1 mb-30">Szűrés ár szerint</h5>
        <div class="price-filter">
            <div class="price-filter-inner">
            <div id="slider-range" class="price-filter-range" data-min="0" data-max="75000 "></div>
            <input type="text" id="amount" value="1000 - 75 000" readonly>
            <br><br>

            <div class="slider-container">
                <div id="range-slider" class="range-slider"></div>
                <input type="hidden" id="price_range" name="price_range" value="">
                <div class="slider-label">
                    <label for="rangeSlider" id="minValue">0 </label>
                    <label for="rangeSlider" id="maxValue">75000 </label>
                </div>
            </div>
               
                <button type="submit" class="btn btn-sm btn-default"><i class="fi-rs-filter mr-5"></i>Szűrés</button>
            </div>
        </div>
        <div class="list-group">
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
        </div>
        
    </div>
      </form>
                    <!--
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

                    -->             
                </div>
            </div>
        </div>

@endsection