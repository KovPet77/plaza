    
@extends('frontend.master_dashboard')
@section('main')


@section('title')
Kezdőlap
@endsection


@include('frontend.home.home_slider')
@include('frontend.home.home_features_category')
@include('frontend.home.home_banner')
@include('frontend.home.home_new_product')
@include('frontend.home.home_features_product')






<section class="section-padding mb-30">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 wow animate__animated animate__fadeInUp" data-wow-delay="0">
                <h4 class="section-title style-1 mb-30 animated animated"> Rendkívüli ajánlatok</h4>
                <div class="product-list-small animated animated">

                    @foreach($hot_deals as $item)
                    <article class="row align-items-center hover-up">
                        <figure class="col-md-4 mb-0">
                            <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug)}}"><img src="{{asset($item->product_thumbnail)}}" alt="" /></a>
                        </figure>
                        <div class="col-md-8 mb-0">
                            <h6>
                                <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug)}}">{{ $item->product_name}}</a>
                            </h6>
                            <div class="product-rate-cover">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: 90%"></div>
                                </div>
                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                            </div>
                              @if($item->discount_price == NULL)
                            <div class="product-price mt-10">                                          
                                <span >{{ number_format($item->selling_price, 0, ',', ' ') . ' Ft.' }}</span>
                            </div>

                             @else
                             <div class="product-price mt-10">
                                <span>{{ number_format($item->discount_price, 0, ',', ' ') . ' Ft.' }}</span>
                                <span class="old-price">{{ number_format($item->selling_price, 0, ',', ' ') . ' Ft.' }}</span>
                            </div>
                             @endif
                        </div>
                    </article>
                    @endforeach





                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 mb-md-0 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                <h4 class="section-title style-1 mb-30 animated animated">Különleges ajánlatok</h4>
                <div class="product-list-small animated animated">


                   @foreach($special_offers as $item)
                    <article class="row align-items-center hover-up">
                        <figure class="col-md-4 mb-0">
                            <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug)}}"><img src="{{asset($item->product_thumbnail)}}" alt="" /></a>
                        </figure>
                        <div class="col-md-8 mb-0">
                            <h6>
                                <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug)}}">{{ $item->product_name}}</a>
                            </h6>
                            <div class="product-rate-cover">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: 90%"></div>
                                </div>
                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                            </div>
                              @if($item->discount_price == NULL)
                            <div class="product-price mt-10">                                          
                                <span >{{ number_format($item->selling_price, 0, ',', ' ') . ' Ft.' }}</span>
                            </div>

                             @else
                             <div class="product-price mt-10">
                                <span>{{ number_format($item->discount_price, 0, ',', ' ') . ' Ft.' }}</span>
                                <span class="old-price">{{ number_format($item->selling_price, 0, ',', ' ') . ' Ft.' }}</span>
                            </div>
                             @endif
                        </div>
                    </article>
                    @endforeach




                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-lg-block wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                <h4 class="section-title style-1 mb-30 animated animated">Nemrég hozzáadott</h4>
                <div class="product-list-small animated animated">


             @foreach($new_products as $item)
                    <article class="row align-items-center hover-up">
                        <figure class="col-md-4 mb-0">
                            <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug)}}"><img src="{{asset($item->product_thumbnail)}}" alt="" /></a>
                        </figure>
                        <div class="col-md-8 mb-0">
                            <h6>
                                <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug)}}">{{ $item->product_name}}</a>
                            </h6>
                            <div class="product-rate-cover">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: 90%"></div>
                                </div>
                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                            </div>
                              @if($item->discount_price == NULL)
                            <div class="product-price mt-10">                                          
                                <span >{{ number_format($item->selling_price, 0, ',', ' ') . ' Ft.' }}</span>
                            </div>

                             @else
                             <div class="product-price mt-10">
                                <span>{{ number_format($item->discount_price, 0, ',', ' ') . ' Ft.' }}</span>
                                <span class="old-price">{{ number_format($item->selling_price, 0, ',', ' ') . ' Ft.' }}</span>
                            </div>
                             @endif
                        </div>
                    </article>
                    @endforeach

                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-xl-block wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
                <h4 class="section-title style-1 mb-30 animated animated">Speciális vétel</h4>
                <div class="product-list-small animated animated">



             @foreach($special_deals as $item)
                    <article class="row align-items-center hover-up">
                        <figure class="col-md-4 mb-0">
                            <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug)}}"><img src="{{asset($item->product_thumbnail)}}" alt="" /></a>
                        </figure>
                        <div class="col-md-8 mb-0">
                            <h6>
                                <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug)}}">{{ $item->product_name}}</a>
                            </h6>
                            <div class="product-rate-cover">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: 90%"></div>
                                </div>
                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                            </div>
                              @if($item->discount_price == NULL)
                            <div class="product-price mt-10">                                          
                                <span >{{ number_format($product->selling_price, 0, ',', ' ') . ' Ft.' }}</span>
                            </div>

                             @else
                             <div class="product-price mt-10">
                                <span>{{ number_format($item->discount_price, 0, ',', ' ') . ' Ft.' }}</span>
                                <span class="old-price">{{ number_format($item->selling_price, 0, ',', ' ') . ' Ft.' }}</span>
                            </div>
                             @endif
                        </div>
                    </article>
                    @endforeach



                  
                </div>
            </div>
        </div>
    </div>
</section>
<!--End 4 columns-->
@include('frontend.home.home_vendor')

<!--Vendor List -->

<!--End Vendor List -->
@endsection