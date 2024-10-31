@extends('frontend.master_dashboard')
@section('main')
@section('title')
Összes üzlet
@endsection
	<div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('/')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Kezdőlap</a>
                    <span></span> Eladók listája
                </div>
            </div>
        </div>
        <div class="page-content pt-50">
            <div class="container">
                <div class="archive-header-2 text-center">
                    <h1 class="display-2 mb-50">Eladók, üzletek listája</h1>
                    <div class="row">
                        <div class="col-lg-5 mx-auto">
                            <div class="sidebar-widget-2 widget_search mb-50">
                         <div class="search-form">
                   <form action="{{ route('search.vendor')}}" method="post">
                        @csrf
                        <input onfocus="search_result_show()" onblur="search_result_hide()" name="search" id="searchVendorInput" placeholder="Üzlet keresése..." />
                        <div id="searchVendorResults"></div>
                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-50">
                    <div class="col-12 col-lg-8 mx-auto">
                        <div class="shop-product-fillter">
                            <div class="totall-product">
                                <!--
                                <p><strong class="text-brand">{{  count($vendors) }}</strong> eladónk van </p>
                                -->
                            </div>
                    
                        </div>
                    </div>
                </div>


                
                <div class="row vendor-grid">


                	@foreach($vendors as $vendor)
                    <div class="col-lg-3 col-md-6 col-12 col-sm-6">

                        <input type="hidden" name="id" value="{{ $vendor->id }}">
                        <div class="vendor-wrap mb-40">
                            <div class="vendor-img-action-wrap">
                                <div class="vendor-img">
                                    <a href="{{ route('vendor.details', $vendor->vendor_slug)}}">
                                    <img class="default-img" src="{{ (!empty($vendor->photo)) ? url('upload/vendor_images/'.$vendor->photo) : url('upload/no_image.jpg') }}" alt=""  style="width: 120px; height:120px" />
                                    </a>
                                </div>
                                <div class="product-badges product-badges-position product-badges-mrg">
                                    @if($vendor->katalogus == 'katalogus')
                                    <span class="hot" style="background:#3BB77E">Katalógus profil</span>

                                    @else
                                     <span class="hot">Webshop profil</span>
                                    @endif
                                </div>
                            </div>
                            <div class="vendor-content-wrap">
                                <div class="d-flex justify-content-between align-items-end mb-30">
                                    <div>
                                        <div class="product-category">
                                            <span class="text-muted">{{ $vendor->vendor_join}} óta</span>
                                        </div>
                                        <h4 class="mb-5"><a href="{{ route('vendor.details', $vendor->vendor_slug)}}">{{ $vendor->name}}</a></h4>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                        </div>
                                    </div>
                                    @php
                                    $products = App\Models\Product::where('vendor_id', $vendor->id)->get();
                                    @endphp
                                    <div class="mb-10">
                                        <span class="font-small total-product">{{ count($products) }} Termék</span>
                                    </div>
                                </div>
                                <div class="vendor-info mb-30">
                                    <ul class="contact-infor text-muted">
                                        <li><img src="assets/imgs/theme/icons/icon-location.svg" alt="" /><strong>Cím: </strong> <span>{{ $vendor->address}}</span></li>
                                        <li><img src="assets/imgs/theme/icons/icon-contact.svg" alt="" /><strong>Telefon:</strong><span>{{ $vendor->phone}}</span></li>
                                    </ul>
                                </div>
                                <a href="{{ route('vendor.details', $vendor->vendor_slug)}}" class="btn btn-xs">Eladó Termékei<i class="fi-rs-arrow-small-right"></i></a>
                            </div>
                        </div>
                    </div>
                      @endforeach                   
                </div>
        <div class="pagination-area mt-20 mb-20">
        {{ $vendors->links('vendor.pagination.custom')}}
        </div>
            </div>
        </div>
 

@endsection