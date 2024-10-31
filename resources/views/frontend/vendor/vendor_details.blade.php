@extends('frontend.master_dashboard')
@section('main')
@section('title')
Üzlet adatai
@endsection
<div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Kezdőlap</a>
                  <span></span> Eladó termékei
                </div>
            </div>
        </div>
        <div class="container mb-30">
            <div class="archive-header-2 text-center pt-80 pb-50">

                <p style="font-size:25px;" >Üzlet kategóriái, alkategóriái</p>
               
            </div>
    <div class="row flex-row-reverse">
        <div class="col-lg-4-5">
            <div class="shop-product-fillter">
                <div class="totall-product">
               
                </div>          
            </div>


<div class="row product-grid">
       @foreach ($subcategoryImages as $subcategory)
<div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
<div class="card-2 bg-9 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
    <figure class="img-hover-scale overflow-hidden">
        <a href="{{ url('product/subcategory/'.$subcategory->id.$subcategory->subcategory_slug) }}"><img src="{{ asset($subcategory->subcategory_image) }}" alt="{{ $subcategory->subcategory_name }}"  style="width:100%; height:auto;" /></a>
    </figure>
    <h6>
        <a href="{{url('product/subcategory/'.$subcategory->id.$subcategory->subcategory_slug) }}">
            {{ $subcategory->subcategory_name}}
        </a>
    </h6>
</div>


</div>               
@endforeach       
</div>







                 

                 
                    <!--End Deals-->
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
                                <h6 class="mb-15">Follow Us</h6>
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

@endsection