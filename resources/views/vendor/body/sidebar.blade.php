
@php

	$id = Auth::user()->id;
	$vendorId = App\Models\User::find($id);
	$status = $vendorId->status;

@endphp


<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<img src="{{ asset('adminbackend/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
				</div>
				<div>
					<h4 class="logo-text">Üzlet</h4>
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu">

			    <li>
					<a href="{{route('vendor.dashboard')}}">
						<div class="parent-icon"><i class='bx bx-cookie'></i>
						</div>
						<div class="menu-title">Irányítópult</div>
					</a>
				</li>

				@if($status == 'active')
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Termékek kezelése</div>
					</a>
					<ul>
						<li> <a href="{{ route('vendor.all.product') }}"><i class="bx bx-right-arrow-alt"></i>Összes termék</a>
						</li>
						<li> <a href="{{ route('vendor.add.product') }}"><i class="bx bx-right-arrow-alt"></i>Termékek hozzáadása</a>
						</li>

					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Rendelések kezelése</div>
					</a>
					<ul>
						<li>
						 <a href="{{ route('vendor.order')}}"><i class="bx bx-right-arrow-alt"></i>Rendelések</a>
						</li>

						<li>
						 <a href="{{ route('vendor.return.order')}}"><i class="bx bx-right-arrow-alt"></i>Visszaküldött rendelések</a>
						</li>

						<li>
						 <a href="{{ route('vendor.complate.return.order')}}"><i class="bx bx-right-arrow-alt"></i>Visszaküldött rendelés teljesítése</a>
						</li>
		
					</ul>
				</li>
				@else
				@endif
		
			</ul>
			<!--end navigation-->
		</div>