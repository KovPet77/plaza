@extends('frontend.master_dashboard')
@section('main')
<!--Figyelem. Így kell a dinamikus title-t készíteni -->
@section('title')
 {{ $advertiser->name }} 
@endsection
<div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('/')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Kezdőlap</a>
                    <span>{{ $advertiser->name }} </span> <a href=""></a> 
                </div>
            </div>
        </div>
        <div class="container mb-30">
            <div class="row">
                <div class="col-xl-10 col-lg-12 m-auto">
                    <div class="product-detail accordion-detail">
                        <div class="row mb-50 mt-30">
                            <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                                <div class="detail-gallery">
                              
                                    <!-- MAIN SLIDES -->
                                    <div class="product-image-slider">
                                        
                                
                                        
                                    </div>
                                    <div class="slider-nav-thumbnails">
                                       
                                   

                                        </div>
                                        <img src="{{ (!empty($advertiser->photo)) ? url($advertiser->photo) : url('upload/no_image.jpg') }}" alt=""  style="width: 100%; height:auto; !important" />
                                        
                                    </div>
                                </div>
                                <!-- End Gallery -->
                            </div>
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="detail-info pr-30 pl-30">

                <h2 class="title-detail" id="dpname"> {{ $advertiser->name }} </h2>
                <div class="detail-extralink mb-50">
            
                    <div class="product-extra-link2">
                   
                    </div>
                </div>
<hr>
                                </div>
                                <!-- Detail Info -->
                            </div>
                        </div>
                        <!--
                        <div class="product-info">
                            <div class="tab-style3">
                                <ul class="nav nav-tabs text-uppercase">    
                                    <li class="nav-item">
                                        <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description">Leírás</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="Additional-info-tab" data-bs-toggle="tab" href="#Additional-info">További információ</a>
                                    </li>
                                </ul>
                                <div class="tab-content shop_info_tab entry-main-content">
                                    <div class="tab-pane fade show active" id="Description">
                                        <div class="">
                                          {!! htmlspecialchars_decode($advertiser->leiras) !!}
              
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="Additional-info">
                                <p>Email: {{ $advertiser->email }} </p>        <p> Telefon: {{ $advertiser->phone }} </p>
                                    </div>
                                    <div class="tab-pane fade" id="Vendor-info">
                                        <div class="vendor-logo d-flex mb-30">
                                            <!--
                                            <img src="{{ (!empty($product->vendor->photo)) ? url('upload/vendor_images/'.$product->vendor->photo) : url('upload/no_image.jpg') }}" alt=""  style="width:50%; height:auto;"/>
                                            -->
                                            
                                            
                                            <div class="vendor-name ml-15">
                                      
                                                    <span class="font-small ml-5 text-muted"> (32 reviews)</span>
                                                </div>
                                            </div>
                                        </div>
                                    
                                    
                                    </div>
                                    <div class="tab-pane fade" id="Reviews">
                                        <!--Comments-->
                                        <div class="comments-area">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <h4 class="mb-30">Customer questions & answers</h4>
                                                    <div class="comment-list">
                                                        <div class="single-comment justify-content-between d-flex mb-30">
                                                            <div class="user justify-content-between d-flex">
                                                                <div class="thumb text-center">
                                                                    <img src="assets/imgs/blog/author-2.png" alt="" />
                                                                    <a href="#" class="font-heading text-brand">Sienna</a>
                                                                </div>
                                                                <div class="desc">
                                                                    <div class="d-flex justify-content-between mb-10">
                                                                        <div class="d-flex align-items-center">
                                                                            <span class="font-xs text-muted">December 4, 2022 at 3:12 pm </span>
                                                                        </div>
                                                                        <div class="product-rate d-inline-block">
                                                                            <div class="product-rating" style="width: 100%"></div>
                                                                        </div>
                                                                    </div>
                                                              
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="single-comment justify-content-between d-flex mb-30 ml-30">
                                                            <div class="user justify-content-between d-flex">
                                                                <div class="thumb text-center">
                                                                    <img src="assets/imgs/blog/author-3.png" alt="" />
                                                                    <a href="#" class="font-heading text-brand">Brenna</a>
                                                                </div>
                                                                <div class="desc">
                                                                    <div class="d-flex justify-content-between mb-10">
                                                                        <div class="d-flex align-items-center">
                                                                            <span class="font-xs text-muted">December 4, 2022 at 3:12 pm </span>
                                                                        </div>
                                                                        <div class="product-rate d-inline-block">
                                                                            <div class="product-rating" style="width: 80%"></div>
                                                                        </div>
                                                                    </div>
                                                       
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="single-comment justify-content-between d-flex">
                                                            <div class="user justify-content-between d-flex">
                                                                <div class="thumb text-center">
                                                                    <img src="assets/imgs/blog/author-4.png" alt="" />
                                                                    <a href="#" class="font-heading text-brand">Gemma</a>
                                                                </div>
                                                                <div class="desc">
                                                                    <div class="d-flex justify-content-between mb-10">
                                                                        <div class="d-flex align-items-center">
                                                                            <span class="font-xs text-muted">December 4, 2022 at 3:12 pm </span>
                                                                        </div>
                                                                        <div class="product-rate d-inline-block">
                                                                            <div class="product-rating" style="width: 80%"></div>
                                                                        </div>
                                                                    </div>
                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <h4 class="mb-30">Customer reviews</h4>
                                                    <div class="d-flex mb-30">
                                                        <div class="product-rate d-inline-block mr-15">
                                                            <div class="product-rating" style="width: 90%"></div>
                                                        </div>
                                                        <h6>4.8 out of 5</h6>
                                                    </div>
                                                    <div class="progress">
                                                        <span>5 star</span>
                                                        <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
                                                    </div>
                                                    <div class="progress">
                                                        <span>4 star</span>
                                                        <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                                    </div>
                                                    <div class="progress">
                                                        <span>3 star</span>
                                                        <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">45%</div>
                                                    </div>
                                                    <div class="progress">
                                                        <span>2 star</span>
                                                        <div class="progress-bar" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">65%</div>
                                                    </div>
                                                    <div class="progress mb-30">
                                                        <span>1 star</span>
                                                        <div class="progress-bar" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">85%</div>
                                                    </div>
                                                    <a href="#" class="font-xs text-muted">How are ratings calculated?</a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                             -->
                            
                        </div>


                        <div class="row mt-60">
                            <div class="col-12">
                                <!--
                                <h2 class="section-title style-1 mb-30">Hasonló termékek</h2>
                                -->
                            </div>
                            <div class="col-12">
                                <div class="row related-products">
      


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection