
@php

$route = Route::current()->getName();

@endphp
 <!-- Start col md3 menu-->
<div class="col-md-3">
    <div class="dashboard-menu">
        <ul class="nav flex-column" role="tablist">
 <!--
          <li class="nav-item">
                <a class="nav-link {{ ($route == 'user.index') ? 'active' : '' }}" id="dashboard-tab" data-bs-toggle="tab" href="{{ route('user.index')}}" ><i class="fi-rs-settings-sliders  mr-10"></i>Irányítópult</a>
            </li>
-->


            
            <li class="nav-item">
                <a class="nav-link {{ ($route == 'dashboard') ? 'active' : '' }}" id="dashboard-tab" data-bs-toggle="tab" href="{{ route('dashboard') }}" ><i class="fi-rs-settings-sliders  mr-10"></i>Irányítópult</a>
            </li>
            <li class="nav-item">
                <a class="nav-link  {{ ($route == 'user.order.page') ? 'active' : '' }}"href="{{ route('user.order.page')}}" ><i class="fi-rs-shopping-bag mr-10"></i>Rendeléseim</a>
            </li>

           <li class="nav-item">
                <a class="nav-link  {{ ($route == 'return.order.page') ? 'active' : '' }}"href="{{ route('return.order.page')}}" ><i class="fi-rs-shopping-bag mr-10"></i>Visszaküldött rendeléseim</a>
            </li>
          
            <li class="nav-item">
                <a class="nav-link  {{ ($route == 'user.track.order') ? 'active' : '' }}"  href="{{route('user.track.order') }}" role="tab" ><i class="fi-rs-shopping-cart-check mr-10"></i>Rendelés nyomonkövetése</a>
            </li>
     
      
            <li class="nav-item">
                <a class="nav-link  {{ ($route == 'user.account.page') ? 'active' : '' }}"  href="{{ route('user.account.page')}}"><i class="fi-rs-user mr-10"></i>Fiók adatai</a>
            </li>
            <li class="nav-item">
                <a class="nav-link  {{ ($route == 'user.change.password') ? 'active' : '' }}" href="{{ route('user.change.password')}}" ><i class="fi-rs-user mr-10"></i>Jelszó változtatás</a>
            </li>
            <li class="nav-item" style="background:#ddd">
                <a class="nav-link" href="{{route('user.logout')}}"><i class="fi-rs-sign-out mr-10"></i>Kilépés</a>
            </li>
        </ul>
    </div>
</div>