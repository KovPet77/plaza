

<header class="header-area header-style-1 header-height-2">
     <!--
    
        <div class="mobile-promotion">
            <span>Akció, <strong> 15%-os árengedmény</strong> Minden termékre <strong>csak 3 nap </strong>maradt</span>
        </div>
         -->
        
        
        <div class="header-top header-top-ptb-1 d-none d-lg-block" >
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-3 col-lg-4">
                        <div class="header-info">
                            <ul>
                                
                                <li><a href="/kosar">Kosaram</a></li>
                          
                            </ul> 
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-4">
                        <div class="text-center">
                            <div id="news-flash" class="d-inline-block">
                                <ul>
                                    <li>Remek ajánlatok, kuponnal rendelkező vásárlóknak!</li>
                                    <li>Vacsora ajánlatok – Takarítson meg többet a kuponokkal</li>
                                    <li>Divatos 25 ezüst ékszer, takarítson meg 35% kedvezményt még ma</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4">
                        <div class="header-info header-info-right">
                            <ul>
                  

                                 <li>Segítségre van szükséged? <strong class="text-brand"> +36 20...</strong></li>
                               
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        @php

        $setting = App\Models\SiteSetting::find(1);
        @endphp

        <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="header-wrap">
                    <div class="logo logo-width-1">
                        <!-- Statikus logo   -->
                        <a href="{{ route('/') }}"><img src="{{asset('frontend/assets/imgs/theme/LogoPlaza.png')}}" alt="logo" /></a>
                       
                    </div>
                    <div class="header-right">
                        <div class="search-style-2">
                            <form action="{{ route('product.search')}}" method="post" onsubmit="return false;">
                                 @csrf


                                <input onfocus="search_result_show()" onblur="search_result_hide()" name="search" id="search" placeholder="Termék keresése..." />
                                <div id="searchProducts"></div>
                            </form>
                        </div>


     

    <div class="header-action-right">
        <div class="header-action-2">

@php
    $totalQuantity = 0; // Kezdetben a mennyiség nulla
@endphp

@foreach(Cart::content() as $item)
   
    @php
        $totalQuantity += $item->qty; // Minden elem mennyiségét hozzáadod a teljes mennyiséghez
    @endphp
    
@endforeach               

 <div class="header-action-icon-2">
        <a href="{{ route('compare') }}">
            <img class="svgInject" alt="pomazplaza" src="{{ asset('frontend/assets/imgs/theme/icons/icon-compare.svg')}}" />
        </a>
        <a href="{{ route('compare') }}"><span class="lable ml-0">Összehasonlítás</span></a>
    </div>
        <div class="header-action-icon-2">
            <a href="">           
                <img class="svgInject" alt="pomazplaza" src="{{ asset('frontend/assets/imgs/theme/icons/icon-heart.svg') }}" />
                <span class="pro-count blue" id="wishQty">0</span>
            </a>
            <a href="{{ route('wishlist') }}"><span class="lable">Kívánságlista</span></a>
        </div>
            <div class="header-action-icon-2">
                <a class="mini-cart-icon" href="">
                    <img alt="pomazplaza" src="{{ asset('frontend/assets/imgs/theme/icons/icon-cart.svg')}}" />
                    <span class="pro-count blue" id="cartQty">{{ $totalQuantity }}</span>
                </a>
                <a href="{{ url('/kosar')}}"><span class="lable">Kosár</span></a>
                <div class="cart-dropdown-wrap cart-dropdown-hm2">


                    <div id="miniCart">
                        
                    </div>

                    <div class="shopping-cart-footer">
                        <div class="shopping-cart-total">
                            <h4>Fizetendő <span id="cartSubTotal"> </span></h4>
                        </div>
                        <div class="shopping-cart-button">
                            <a href="{{ url('/kosar')}}" class="outline">Kosárhoz</a>
                            <a href="{{ url('/penztar')}}">Pénztárhoz</a>
                        </div>
                    </div>
                </div>
            </div>



<div class="header-action-icon-2">
    <a href="page-account.html">
        <img class="svgInject" alt="pomazplaza" src="{{ asset('frontend/assets/imgs/theme/icons/icon-user.svg') }}" />
    </a>


        @auth             


        <a href=""><span class="lable ml-0">Fiók</span></a>
    <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
        <ul>
            <li>
                <a href="{{ route('dashboard') }}">Irányítópult</a>
            </li>
            <li>
                <a href="{{ route('user.order.page')}}">Rendeléseim</a>
            </li>
            <li>
                <a href="{{ route('return.order.page')}}">Visszaküldött rendeléseim</a>
            </li>
            <li>
                <a href="{{route('user.track.order') }}">Rendelés nyomonkövetése</a>
            </li>
            <li>
                <a href="{{ route('user.account.page')}}"></i>Fiók adatai</a>
            </li>
               <li>
                <a href="{{ route('user.change.password')}}"></i>Jelszó változtatás</a>
            </li>
            <li>
                <a href="{{ route('user.logout')}}"><i class="fi fi-rs-sign-out mr-10"></i>Kilépés</a>
            </li>
        </ul>
    </div>


        @else
        <a href="{{ route('login')}}"><span class="lable ml-0">Bejelentkezés</span></a> 
        <span class="lable" style="margin-left: 2px; margin-right: 2px;"> | </span>   
        <a href="{{ route('regisztracio')}}"><span class="lable ml-0">Regisztráció</span></a>    
           

        @endauth
</div>
</div>
</div>
</div>
</div>
</div>
</div>
     
        @php
        $categories = App\Models\Category::orderBy('category_name','ASC')->get();       
        @endphp


        <div class="header-bottom header-bottom-bg-color sticky-bar">
            <div class="container">
                <div class="header-wrap header-space-between position-relative">
                    <div class="logo logo-width-1 d-block d-lg-none">
                        <a href="{{ route('/') }}"><img style="width:100px; min-width:100px;" src="{{asset('frontend/assets/imgs/theme/LogoPlaza.png') }}" alt="logo" /></a>
                    </div>
                    <div class="header-nav d-none d-lg-flex">
                        <div class="main-categori-wrap d-none d-lg-block">
                            <a class="categories-button-active" href="#">
                                <span class="fi-rs-apps"></span>  Összes Kategória
                                <i class="fi-rs-angle-down"></i>
                            </a>
                            <div class="categories-dropdown-wrap categories-dropdown-active-large font-heading">
                                <div class="d-flex categori-dropdown-inner">
                                    <ul>
                                        @foreach($categories as $item)

                                        @if($loop->index < 5 )
                                        <li>
                                            <a  href="{{ url('product/category/'.$item->id.'/'.$item->category_slug)}}"> <img src="{{ asset($item->category_image) }}" alt="" />{{ $item->category_name}}</a>
                                        </li>
                                        @endif
                                        @endforeach
                                 
                                    </ul>
                                    <ul class="end">
                                        @foreach($categories as $item)
                                        @if($loop->index > 4 )
                                        <li>
                                            <a  href="{{ url('product/category/'.$item->id.'/'.$item->category_slug)}}"> <img src="{{ asset($item->category_image) }}" alt="" />{{ $item->category_name}}</a>
                                        </li>
                                        @endif
                                        @endforeach
                                
                                    </ul>
                                </div>


                                
                                <div class="more_slide_open" style="display: none">
                                    <div class="d-flex categori-dropdown-inner">
                                        <ul>
                                            <li>
                                                <a href="shop-grid-right.html"> <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-1.svg') }}" alt="" />Milks and Dairies</a>
                                            </li>
                                            <li>
                                                <a href="shop-grid-right.html"> <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-2.svg') }}" alt="" />Clothing & beauty</a>
                                            </li>
                                        </ul>
                                        <ul class="end">
                                            <li>
                                                <a href="shop-grid-right.html"> <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-3.svg') }}" alt="" />Wines & Drinks</a>
                                            </li>
                                            <li>
                                                <a href="shop-grid-right.html"> <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-4.svg') }}" alt="" />Fresh Seafood</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                
                          
                            </div>
                            
                            
                        </div>
                        <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading">
                            <nav>
                                <ul>
                                    
                                    <li>
                                        <a class="active" href="{{ url('/')}}">Kezdőlap</a>
                                        
                                    </li>
                                    <li>
                                        <a href="{{ route('vendor.all')}}">Üzletek-Katalógusok</a>
                                    </li>

                                      <li>
                                        <a href="{{ route('osszes.hirdeto') }}">Hirdetők</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>


                    <div class="hotline d-none d-lg-flex">
                        
                        <p>{{ $setting->support_phone}}<span>Ügyfélszolgálat</span></p>
                    </div>
                    <div class="header-action-icon-2 d-block d-lg-none">
                        <div class="burger-icon burger-icon-white">
                            <span class="burger-icon-top"></span>
                            <span class="burger-icon-mid"></span>
                            <span class="burger-icon-bottom"></span>
                        </div>
                    </div>


<!-- Mobil mini cart -->

<div class="header-action-right d-block d-lg-none">
    <div class="header-action-2">
        <div class="header-action-icon-2">
            <a href="{{ route('wishlist') }}">
                <img alt="pomazplaza" src="{{ asset('frontend/assets/imgs/theme/icons/icon-heart.svg')}}" />
                <span class="pro-count white" id="wishQty">0</span>
            </a>
        </div>
        <div class="header-action-icon-2">
            <a class="mini-cart-icon" href="#">
                <a href="{{ url('/kosar') }}"><img alt="pomazplaza" src="{{ asset('frontend/assets/imgs/theme/icons/icon-cart.svg')}}" />
                <span class="pro-count white" id="cartQtyMobil"></span></a>
            <div class="cart-dropdown-wrap cart-dropdown-hm2">
                   <div id="miniCartMobil">
                        
                    </div>
                <div class="shopping-cart-footer">
                    <div class="shopping-cart-total">
                        <h4>Fizetendő <span id="cartSubTotalMobil"></span></h4>
                    </div>
                    <div class="shopping-cart-button">
                        <a href="{{ url('/kosar') }}">Kosárhoz</a>
                        <a href="{{ url('/penztar') }}">Pénztárhoz</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


                </div>
            </div>
        </div>
    </header>

<script>
    // Ajax keresés. A live listát eltünteti ha mellékattint bárhova
    function search_result_show(){

        $("#searchProducts").slideDown();
    }  


      function search_result_hide(){
        $("#searchProducts").slideUp();
        
    }
</script>

    <div class="mobile-header-active mobile-header-wrapper-style">
        <div class="mobile-header-wrapper-inner">
            <div class="mobile-header-top">
                <div class="mobile-header-logo">
                    <a href="{{ route('/') }}"><img src="{{asset('frontend/assets/imgs/theme/LogoPlaza.png')}}" alt="logo" /></a>
                </div>
                <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                    <button class="close-style search-close">
                        <i class="icon-top"></i>
                        <i class="icon-bottom"></i>
                    </button>
                </div>
            </div>
            <div class="mobile-header-content-area">
        
                <div class="mobile-menu-wrap mobile-header-border">
                  
                    <nav>
                        <ul class="mobile-menu font-heading">
                            <li class="menu-item-has-children">
                                <a href="/">Kezdőlap</a>
                                 
                            </li>
                            
                            <li class="menu-item-has-children">
                                <a href="#">Összes kategória</a>
                                <ul class="dropdown">
                                    <li class="menu-item-has-children">
                        @php
                        $categories = App\Models\Category::orderBy('category_name', 'ASC')->limit(6)->get();
                        @endphp

                        @foreach($categories as $category)
                        <li class="menu-item-has-children">
                            <a href="{{ url('product/category/'.$category->id.'/'.$category->category_slug)}}">
                                {{ $category->category_name }} 
                            </a>

                            @php
                            $subcategories = App\Models\SubCategory::where('category_id', $category->id)->orderBy('subcategory_name', 'ASC')->get();
                            @endphp

                            <ul class="dropdown">
                                @foreach($subcategories as $subcategory)
                                <li>
                                    <a href="{{ url('product/subcategory/'.$subcategory->id.'/'.$subcategory->subcategory_slug) }}">{{ $subcategory->subcategory_name }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        @endforeach
                                    </li>
                         
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="/login">Fiókom</a>
                       
                            </li>
                            
                                <li class="menu-item-has-children">
                                <a href="/osszes-uzlet">Üzletek-Katalógusok</a>
                       
                            </li>
                                <li class="menu-item-has-children">
                                <a href="{{ route('osszes.hirdeto') }}">Hirdetők</a>
                       
                            </li>
                            <li class="menu-item-has-children">
                                <a href="/regisztracio">Regisztráció</a>
                      
                            </li>
                            
                        </ul>
                    </nav>
                
                </div>
                <div class="mobile-header-info-wrap">
                    <div class="single-mobile-header-info">
                        <a href="page-contact.html"><i class="fi-rs-marker"></i>Elérhetőség</a>
                    </div>
                 
                    <div class="single-mobile-header-info">
                        <a href="#">hello@pomazplaza.hu</a>
                    </div>
                </div>
                <div class="mobile-social-icon mb-50">
                    <h6 class="mb-15">Kövess minket</h6>
                    <a href="https://www.facebook.com/profile.php?id=61553962433188"><img src="{{asset('frontend/assets/imgs/theme/icons/icon-facebook-white.svg')}}" alt="pomazplaza" /></a>
                    <!--
                    <a href="#"><img src="{{asset('frontend/assets/imgs/theme/icons/icon-twitter-white.svg')}}" alt="" /></a>
                    <a href="#"><img src="{{asset('frontend/assets/imgs/theme/icons/icon-instagram-white.svg')}}" alt="" /></a>
                    <a href="#"><img src="{{asset('frontend/assets/imgs/theme/icons/icon-pinterest-white.svg')}}" alt="" /></a>
                    <a href="#"><img src="{{asset('frontend/assets/imgs/theme/icons/icon-youtube-white.svg')}}" alt="" /></a>
                    -->
                    
                </div>
                <div class="site-copyright">Copyright 2023 © Pomáz Pláza. Minden jog fenntartva.</div>
            </div>
        </div>
    </div>