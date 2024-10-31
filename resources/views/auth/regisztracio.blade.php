<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" /> 
    <title>Regisztráció</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/assets/imgs/theme/favicon.svg')}}" />
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css?v=5.3')}}" />  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
       <style>
        input{
            border: 1px solid #5e5e5e;
        }
    </style>
</head>

<body>
    
@include('frontend.body.header')  

    <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('/')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Kezdőlap</a>
                    <span></span> Regisztráció
                </div>
            </div>
        </div>
        <div class="page-content pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                        <div class="row">
                            <div class="col-lg-6 col-md-8">
                                <div class="login_wrap widget-taber-content background-white">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h1 class="mb-5">Fiók Létrehozása</h1>
                                            <p class="mb-30">Már van fiókod? <a href="{{ route('login') }}">Belépés</a></p>
                                        </div>
                                        
    <form method="POST" action="{{ route('regisztracio.masodiklepes') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Név')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" disabled />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
           <div>
            <x-input-label for="name" :value="__('Felhasználó név')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="username" :value="old('name')" required autofocus autocomplete="name"  disabled />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username"  disabled />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Jelszó')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" disabled />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Jelszó megerősítése')"   />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" disabled />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

         <div class="mt-4">
            <a href="" style="margin-right:10px;"><label for="checkbox">Elolvastam és megértettem az adatkezelési tájékoztatót</label></a>
         <input type="checkbox" name="adatkezeles"  style="width:3%; height: 14px;" required>
        </div>
         <div class="mt-4">
            <a href="" style="margin-right:10px;"><label for="checkbox">Elolvastam és megértettem a felhasználási feltételeket</label></a>
         <input type="checkbox" name="adatkezeles"  style="width:3%; height: 14px;" required>
        </div>

        <div class="flex items-center justify-end mt-4">
       

            <x-primary-button class="ml-4">
                {{ __('Regisztráció') }}
            </x-primary-button>
        </div>
    </form>

                                    </div>
                                </div>
                            </div>
                                        <!--
                            <div class="col-lg-6 pr-30 d-none d-lg-block">
                                <div class="card-login mt-115">
                                    <a href="#" class="social-login facebook-login">
                                        <img src="{{asset('frontend/assets/imgs/theme/icons/logo-facebook.svg') }}" alt="" />
                                        <span>Belépés Facebook fiókkal</span>
                                    </a>
                                    <a href="#" class="social-login google-login">
                                        <img src="{{asset('frontend/assets/imgs/theme/icons/logo-google.svg') }}" alt="" />
                                        <span>Belépés Google fiókkal</span>
                                    </a>
                                    <a href="#" class="social-login apple-login">
                                        <img src="{{asset('frontend/assets/imgs/theme/icons/logo-apple.svg') }}" alt="" />
                                        <span>Continue with Apple</span>
                                    -->
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


    @include('frontend.body.footer')   


    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                    <!-- <div class="text-center">
                        <img src="{{ asset('frontend/assets/imgs/theme/loading.gif')}}" alt="" />
                    </div> -->
            </div>
        </div>
    </div>
      <script src="{{asset('frontend/assets/js/MiniCart.js')}}"></script>
    <!-- Vendor JS-->
    <script src="{{asset('frontend/assets/js/vendor/modernizr-3.6.0.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/vendor/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/vendor/jquery-migrate-3.3.0.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/vendor/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/slick.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/jquery.syotimer.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/waypoints.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/wow.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/magnific-popup.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/select2.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/counterup.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/jquery.countdown.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/images-loaded.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/isotope.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/scrollup.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/jquery.vticker-min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/jquery.theia.sticky.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/jquery.elevatezoom.js')}}"></script>
  
    <script src="{{asset('frontend/assets/js/main.js?v=5.3')}}"></script>
    <script src="{{asset('frontend/assets/js/shop.js?v=5.3')}}"></script>
</body>

</html> 