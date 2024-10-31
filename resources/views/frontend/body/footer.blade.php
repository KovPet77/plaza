

 @php
$setting = App\Models\SiteSetting::find(1);
@endphp


<footer class="main">
        <section class="newsletter mb-15 wow animate__animated animate__fadeIn">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="position-relative newsletter-inner">
                            <div class="newsletter-content">
                                <h2 class="mb-20">
                                    A Plázában<br />
                                    házhozszállító eladókat is találsz
                                </h2>
                                <p class="mb-45">Kezdje a napi vásárlást itt<span class="text-brand"> Pláza</span></p>
                                <form class="form-subcriber d-flex">
                                    <input type="email" placeholder="Email címed..." />
                                    <button class="btn" type="submit">Feliratkozás hírlevélre</button>
                                </form>
                            </div>
                            <img src="{{asset('frontend/assets/imgs/banner/banner-9.png')}}" alt="newsletter" />
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        
        
        
        <section class="featured section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 mb-md-4 mb-xl-0">
                        <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay="0">
                            <div class="banner-icon">
                                <img src="{{asset('frontend/assets/imgs/theme/icons/icon-1.svg')}}" alt="" />
                            </div>
                            <div class="banner-text">
                                <h3 class="icon-box-title">Legjobb árak és ajánlatok</h3>
                         
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                            <div class="banner-icon">
                                <img src="{{asset('frontend/assets/imgs/theme/icons/icon-2.svg')}}" alt="" />
                            </div>
                            <div class="banner-text">
                                <h3 class="icon-box-title">Gyors szállítás</h3>
                               
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                            <div class="banner-icon">
                                <img src="{{asset('frontend/assets/imgs/theme/icons/icon-3.svg')}}" alt="" />
                            </div>
                            <div class="banner-text">
                                <h3 class="icon-box-title">Nagyszerű napi ajánlat</h3>
                              
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
                            <div class="banner-icon">
                                <img src="{{asset('frontend/assets/imgs/theme/icons/icon-4.svg')}}" alt="" />
                            </div>
                            <div class="banner-text">
                                <h3 class="icon-box-title">Széles választék</h3>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay=".4s">
                            <div class="banner-icon">
                                <img src="{{asset('frontend/assets/imgs/theme/icons/icon-5.svg')}}" alt="" />
                            </div>
                            <div class="banner-text">
                                <h3 class="icon-box-title">Könnyű visszaküldés</h3>
                           
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 d-xl-none">
                        <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay=".5s">
                            <div class="banner-icon">
                                <img src="{{asset('frontend/assets/imgs/theme/icons/icon-6.svg')}}" alt="" />
                            </div>
                            <div class="banner-text">
                                <h3 class="icon-box-title">Safe delivery</h3>
                                <p>Within 30 days</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        
        
        
        
        <section class="section-padding footer-mid">
            <div class="container pt-15 pb-20">
                <div class="row">
                    <div class="col">
                        <div class="widget-about font-md mb-md-3 mb-lg-3 mb-xl-0 wow animate__animated animate__fadeInUp" data-wow-delay="0">
                            <div class="logo mb-30">


                        <!-- Statikus logo   -->
                        <a href=""><img src="{{asset('frontend/assets/imgs/theme/logo.png')}}" alt="logo" /></a>
                       

                        {{--<!-- Dinamikus logo 
                         <a href=""><img src="{{ asset($setting->logo) }}" alt="logo" /></a> -->--}}


                                <p class="font-lg text-heading">Sok minden egyhelyen</p>
                            </div>
                            
                            <!--
                            <ul class="contact-infor">
                                <li><img src="{{asset('frontend/assets/imgs/theme/icons/icon-location.svg')}}" alt="" /><strong>Cím: </strong> <span>{{ $setting->company_address}}</span></li>
                                <li><img src="{{asset('frontend/assets/imgs/theme/icons/icon-contact.svg')}}" alt="" /><strong>Hívj minket:</strong><span>{{ $setting->phone_one}}<span></li>
                                <li><img src="{{asset('frontend/assets/imgs/theme/icons/icon-email-2.svg')}}" alt="" /><strong>Email:</strong><span>{{ $setting->email}}</span></li>
                                <li><img src="{{asset('frontend/assets/imgs/theme/icons/icon-clock.svg')}}" alt="" /><strong>Központ nyitvatartás:</strong><span>10:00 - 18:00, Hétfőtől-Péntekig</span></li>
                            </ul>
                            -->
                            
                        </div>
                    </div>
                    <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                        <h4 class=" widget-title">Cégünk</h4>
                        <ul class="footer-list mb-sm-5 mb-md-0">
                            <li><a href="#">Rólunk</a></li>
                            <li><a href="#">Szállítási információk</a></li>
                            <li><a href="#">Adatvédelem</a></li>
                            <li><a href="#">Felhasználási feltételek</a></li>
                            <li><a href="#">Elérhetőség</a></li>
                            <li><a href="#">Ügyfélszolgálat</a></li>
                           
                        </ul>
                    </div>
                    <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                        <h4 class="widget-title">Fiókom</h4>
                        <ul class="footer-list mb-sm-5 mb-md-0">
                            <li><a href="#">FAQ</a></li>
                           
                        </ul>
                    </div>
                    <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
                        <h4 class="widget-title">Csatlakozás</h4>
                        <ul class="footer-list mb-sm-5 mb-md-0">
                           <!-- <li><a href="{{route ('become.vendor')}}">Legyél eladó</a></li>-->
                             <li><a href="">Legyél eladó</a></li>
                            <li><a href="#">Affiliate Program</a></li>
                            <!-- 
                            <li><a href="#">Farm Business</a></li>
                            <li><a href="#">Farm Careers</a></li>
                            <li><a href="#">Our Suppliers</a></li>
                            <li><a href="#">Accessibility</a></li>
                            <li><a href="#">Promotions</a></li>
                            -->
                        </ul>
                    </div>
                    <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".4s">
                        <h4 class="widget-title">Népszerű</h4>
                        <ul class="footer-list mb-sm-5 mb-md-0">
                            <li><a href="#">Pizzák</a></li>
                            <li><a href="#">Vaj és margarin</a></li>
                            <li><a href="#">Lekvárok</a></li>
                            <li><a href="#">Teák</a></li>
                            <li><a href="#">Sajt</a></li>
                        </ul>
                    </div>
                  
                </div>
        </section>
        <div class="container pb-30 wow animate__animated animate__fadeInUp" data-wow-delay="0">
            <div class="row align-items-center">
                <div class="col-12 mb-30">
                    <div class="footer-bottom"></div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <p class="font-sm mb-0">&copy; 2024, <strong class="text-brand">Plaza</strong> Sok minden egyhelyben <br />Minden jog Fenntartva</p>
                </div>
                <div class="col-xl-4 col-lg-6 text-center d-none d-xl-block">
                     
                    <div class="hotline d-lg-inline-flex">
                        <img src="{{asset('frontend/assets/imgs/theme/icons/phone-call.svg')}}" alt="hotline" />
                        <p><span>24/7 Ügyfélaszolgálat</span></p>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 text-end d-none d-md-block">
    <div class="mobile-social-icon">
        <h6>Kövess minket</h6>
        <a href="{{ $setting->facebook}}"><img src="{{asset('frontend/assets/imgs/theme/icons/icon-facebook-white.svg')}}" alt="" /></a>
        
       
    
    </div>
                    <p class="font-sm">Akár 15% kedvezmény az első feliratkozásodból!</p>
                </div>
            </div>
        </div>
    </footer>