@extends('frontend.master_dashboard')
@section('main')
@section('title')
 Csomagok 
@endsection

    <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="" rel="nofollow"><i class="fi-rs-home mr-5"></i>Kezdőlap</a>
                    <span></span>Csomagok
                </div>
            </div>
        </div>
        <div class="page-content pt-50">
            
            <div class="container">
                <div class="row">
                    
                    <div class="col-xl-10 col-lg-12 m-auto">
                        <section class="text-center mb-50">
                            <div class="row">
                                <div class="col-lg-4 col-md-6 mb-24" style="text-align:left;">
                                    <div class="featured-card">
                                        <img src="{{ asset('frontend/assets/imgs/theme/Logo-grey.png') }}" alt="" />
                                        <h4 style="color:grey;">Hirdetői alap csomag</h4>
                                        <p>Ingyenes bemutatkozási lehetőség</p>
                                        
                                        <ul >
                                            <li>- Szolgaltás neve, telefonszáma</li>
                                            <hr>  
                                            <li>- Bemutatkozó szöveg: 130 karakterig</li>
                                            <hr>
                                                <li>- Fotó feltöltésre nincs lehetőség</li>
                                            <hr>
                                                 <li>- Keresőszó: 3 db</li>
                                            <hr>
                                            <li>- Hirdetés láthatósága: csak regisztrált felhasználóknak</li>
                                            <hr>
                                            <li>három</li>
                                            <hr>
                                        </ul>
                                        <a href="#">Érdekel</a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-24">
                                    <div class="featured-card">
                                        <img src="{{ asset('frontend/assets/imgs/theme/Logo-small.jpg') }}" alt="" />
                                        <h4>Hirdetői haladó csomag</h4>
                                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form</p>
                                        
                                           
                                        <ul>
                                            <li>egy</li>
                                            <hr>
                                            <li>kettő</li>
                                            <hr>
                                            <li>három</li>
                                            <hr>
                                        </ul>
                                        <a href="#">Érdekel</a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-24">
                                    <div class="featured-card">
                                        <img src="{{ asset('frontend/assets/imgs/theme/Logo-small.jpg') }}" alt="" />
                                        <h4>Webshop vagy online katalógus regisztrálás</h4>
                                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form</p>
                                           
                                        <ul>
                                            <li>egy</li>
                                            <hr>
                                            <li>kettő</li>
                                            <hr>
                                            <li>három</li>
                                            <hr>
                                        </ul>
                                        <a href="#">Érdekel</a>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                
                </div>
            </div>
        </div>
    </main>
@endsection
   