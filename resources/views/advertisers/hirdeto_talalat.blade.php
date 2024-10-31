@extends('frontend.master_dashboard')
@section('main')
@section('title')
Összes hirdető
@endsection
	<div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('/')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Kezdőlap</a>
                    <span></span>Hirdetők listája
                </div>
            </div>
        </div>
        <div class="page-content pt-50">
            <div class="container">
                <div class="archive-header-2 text-center">
                    <h1 class="display-2 mb-50">Hirdetők listája</h1>
                    <div class="row">
                        <div class="col-lg-5 mx-auto">
                            <div class="sidebar-widget-2 widget_search mb-50">
                         <div class="search-form">
                   <form action="{{ route('search.advertiser')}}" method="get">
                        @csrf
                        <input  name="search"  placeholder="Hirdető keresése..." />
                        <button type="submit">Keresés</button>
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
                               
                         
                              
                            </div>
                    
                        </div>
                    </div>
                </div>


                
                <div class="row vendor-grid">


                	@foreach($talalat as $talal)
                    <div class="col-lg-3 col-md-6 col-12 col-sm-6">
                        <div class="vendor-wrap mb-40">
                            <div class="vendor-img-action-wrap">
                                <div class="vendor-img">
                                    <a href="{{ route('advertiser.details', $talal->id)}}">
                                    <img class="default-img" src="{{ $talal->photo }}" alt=""  style="width: 120px; height:120px" />
                                    </a>
                                </div>
                                <div class="product-badges product-badges-position product-badges-mrg">
                                    <span class="hot">Hirdetői profil</span>
                                </div>
                            </div>
                            <div class="vendor-content-wrap">
                                <div class="d-flex justify-content-between align-items-end mb-30">
                                    <div>
                                 
                                        <h4 class="mb-5"><a href="{{ route('advertiser.details', $talal->id)}}">{{ $talal->name}}</a></h4>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                        </div>
                                    </div>
                               
                                </div>
                                <div class="vendor-info mb-30">
                                    <ul class="contact-infor text-muted">
                                        <li>
                                            <img src="assets/imgs/theme/icons/icon-location.svg" alt="" /><strong>Cím: </strong> <span>{{ $talal->address}}</span></li>
                    <li><img src="assets/imgs/theme/icons/icon-contact.svg" alt="" /><strong>Telefon:</strong><span>{{ $talal->phone}}</span></li>
                                    </ul>
                                </div>
                                <a href="{{ route('advertiser.details', $talal->id)}}" class="btn btn-xs">Tovább<i class="fi-rs-arrow-small-right"></i></a>
                            </div>
                        </div>
                    </div>
                      @endforeach                   
                </div>
        <div class="pagination-area mt-20 mb-20">
        {{-- $advertiser->links('vendor.pagination.custom') --}}
        </div>
            </div>
        </div>
 

@endsection