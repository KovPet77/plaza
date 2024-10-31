<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					
				</div>
				<div>
					<h4 class="logo-text">Admin</h4>
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu">

			    <li>
					<a href="{{route('admin.dashboard')}}">
						<div class="parent-icon"><i class='bx bx-cookie'></i>
						</div>
						<div class="menu-title">Irányítópult</div>
					</a>
				</li>


				@if(Auth::user()->can('márka.menü'))
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Márka</div>
					</a>
					<ul>
						<li> <a href="{{ route('all.brand')}}"><i class="bx bx-right-arrow-alt"></i>Összes Márka</a>
						</li>
						<li> <a href="{{ route('add.brand')}}"><i class="bx bx-right-arrow-alt"></i>Márka Létrehozása</a>
						</li>	
				
					</ul>
				</li>
				@endif





				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Kategóriák</div>
					</a>
					<ul>
						<li> <a href="{{ route('all.category')}}"><i class="bx bx-right-arrow-alt"></i>Összes kategória</a>
						</li>
						<li> <a href="{{ route('add.category')}}"><i class="bx bx-right-arrow-alt"></i>Kategória hozzáadása</a>
						</li>
						
					</ul>
				</li>

				<li>
				<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Alkategória</div>
					</a>
					<ul>
						<li> <a href="{{ route('all.subcategory')}}"><i class="bx bx-right-arrow-alt"></i>Minden alkategória</a>
						</li>
						<li> <a href="{{ route('add.subcategory')}}"><i class="bx bx-right-arrow-alt"></i>Alkategória hozzáadása</a>
						</li>
						
					</ul>	
				</li>


				<li>
				<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Termékek kezelése</div>
					</a>
					<ul>
						<li> <a href="{{ route('all.product')}}"><i class="bx bx-right-arrow-alt"></i>Minden termék</a>
						</li>
						<li> <a href="{{ route('add.product')}}"><i class="bx bx-right-arrow-alt"></i>Termék hozzáadása</a>
						</li>
						
					</ul>	
				</li>






				<li>
				<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Slider kezelése</div>
					</a>
					<ul>
						<li> <a href="{{ route('all.slider')}}"><i class="bx bx-right-arrow-alt"></i>Minden Slider</a>
						</li>
						<li> <a href="{{ route('add.slider')}}"><i class="bx bx-right-arrow-alt"></i>Slider hozzáadása</a>
						</li>
						
					</ul>	
				</li>


				<li>
				<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Banner kezelése</div>
					</a>
					<ul>
						<li> <a href="{{ route('all.banner')}}"><i class="bx bx-right-arrow-alt"></i>Minden Banner</a>
						</li>
						<li> <a href="{{ route('add.banner')}}"><i class="bx bx-right-arrow-alt"></i>Banner hozzáadás</a>
						</li>
						
					</ul>	
				</li>



				<li>
				<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Kupon rendszer</div>
					</a>
					<ul>
						<li> <a href="{{ route('all.coupon')}}"><i class="bx bx-right-arrow-alt"></i>Minden kupon</a>
						</li>
						<li> <a href="{{ route('add.coupon')}}"><i class="bx bx-right-arrow-alt"></i>Kupon hozzáadása</a>
						</li>
						
					</ul>	
				</li>




				<li>
				<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Szállítás</div>
					</a>
					<ul>
						<li> 
							<a href="{{ route('all.division')}}"><i class="bx bx-right-arrow-alt"></i>Minden megye</a>
						</li>
						<li>
						 <a href="{{ route('all.district')}}"><i class="bx bx-right-arrow-alt"></i>Minden kerület</a>
						</li>

						<li>
						  <a href="{{ route('all.state')}}"><i class="bx bx-right-arrow-alt"></i>Minden state</a>
						</li>
						
					</ul>	
				</li>




			
			
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-cart'></i>
						</div>
						<div class="menu-title">Hirdetők</div>
					</a>
					<ul>
					<li> <a href="{{ route('hirdeto.hozzadas')}}"><i class="bx bx-right-arrow-alt"></i>Hirdető hozzáadása</a>
					</li>
					<li> <a href="{{ route('osszes.hirdeto.backend')}}"><i class="bx bx-right-arrow-alt"></i>Összes hirdető</a>
					</li>
				
					</ul>
				</li>


					<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-cart'></i>
						</div>
						<div class="menu-title">Eladó Kezelése</div>
					</a>
					<ul>
						<li> <a href="{{ route('inactive.vendor')}}"><i class="bx bx-right-arrow-alt"></i>Inaktív Eladók</a>
						</li>
						<li> <a href="{{ route('active.vendor')}}"><i class="bx bx-right-arrow-alt"></i>Aktív Eladók</a>
						</li>
				
					</ul>
				</li>


			<li>
		<a href="javascript:;" class="has-arrow">
			<div class="parent-icon"><i class='bx bx-cart'></i>
			</div>
			<div class="menu-title">Rendelések Kezelése</div>
					</a>
					<ul>
		<li>
		 <a href="{{ route('pending.order')}}"><i class="bx bx-right-arrow-alt"></i>Függő rendelések</a>
		</li>

		<li>
		 <a href="{{ route('admin.confirmed.order')}}"><i class="bx bx-right-arrow-alt"></i>Megerősített rendelések</a></li>

		<li> <a href="{{ route('admin.processing.order')}}"><i class="bx bx-right-arrow-alt"></i>Feldolgozásra váró rendelések</a>
		</li>

		<li>
		 <a href="{{ route('admin.delivered.order')}}"><i class="bx bx-right-arrow-alt"></i>Teljesített rendelések</a></li>
										
				
	   </ul>
				</li>






		<li>
			<a href="javascript:;" class="has-arrow">
				<div class="parent-icon">
					<i class='bx bx-cart'></i>
				</div>
					<div class="menu-title">Visszaküldött rendelések kezelése</div>
					</a>
					<ul>
		<li>
		 <a href="{{ route('return.request')}}"><i class="bx bx-right-arrow-alt"></i>Összes visszaküldött rendelés</a>
		</li>

		<li>
		 <a href="{{ route('complate.return.request')}}"><i class="bx bx-right-arrow-alt"></i>Megerősített visszaküldések</a></li>


										
				
	   </ul>
		</li>


		      <li>
				<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Jelentések kezelése</div>
					</a>
					<ul>
						<li> <a href="{{ route('report.view')}}"><i class="bx bx-right-arrow-alt"></i>Jelentések</a>
						</li>				
						
					</ul>	



					<ul>
						<li> <a href="{{ route('order.by.user')}}"><i class="bx bx-right-arrow-alt"></i>Rendelések üzletek szerint</a>
						</li>				
						
					</ul>
				</li>




			<li>
				<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Felhasználó kezelése</div>
					</a>
					<ul>
						<li> <a href="{{ route('all-user')}}"><i class="bx bx-right-arrow-alt"></i>Összes felhasználó</a>
						</li>				
						
					</ul>	


					<ul>
						<li> <a href="{{ route('all-vendor')}}"><i class="bx bx-right-arrow-alt"></i>Összes üzlet</a>
						</li>				
						
					</ul>
				</li>






				<li>
				<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Beállítások</div>
					</a>
					<ul>
						<li> <a href="{{ route('site.settings')}}"><i class="bx bx-right-arrow-alt"></i>Oldal beállítások</a>
						</li>					
					</ul>
				</li>

			<li>
				<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">SEO Beállítások</div>
					</a>
					<ul>
						<li> <a href="{{ route('seo.settings')}}"><i class="bx bx-right-arrow-alt"></i>SEO beállítások</a>
						</li>					
					</ul>
				</li>


			<li>
				<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Készletek kezelése</div>
					</a>
					<ul>
						<li> <a href="{{ route('product.stock')}}"><i class="bx bx-right-arrow-alt"></i>Készlet</a>
						</li>					
					</ul>
				</li>


				<li>
				<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><span class="icon-people"></span>
						</div>
						<div class="menu-title">Jogosultságok kezelése</div>
					</a>
					<ul>
						<li> <a href="{{ route('all.permission')}}"><i class="bx bx-right-arrow-alt"></i>Összes jogosultság</a>
						</li>					
					</ul>	

					<ul>
						<li> <a href="{{ route('add.permission')}}"><i class="bx bx-right-arrow-alt"></i>Jogosultság hozzáadása</a>
						</li>					
					</ul>

						<ul>
						<li> <a href="{{ route('all.roles')}}"><i class="bx bx-right-arrow-alt"></i>Minden szerep</a>
						</li>


						<li> <a href="{{ route('add.roles.permission')}}"><i class="bx bx-right-arrow-alt"></i>Jogosultsági szerepek</a>
						</li>

						<li> <a href="{{ route('all.roles.permission')}}"><i class="bx bx-right-arrow-alt"></i>Összes jogosultsági szerep</a>
						</li>				
					</ul>
				</li>

			<li>
				<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><span class="icon-people"></span>
						</div>
						<div class="menu-title">Adminok kezelése</div>
					</a>
					<ul>
						<li> <a href="{{ route('all.admin')}}"><i class="bx bx-right-arrow-alt"></i>Összes admin</a>
						</li>					
					</ul>	

					<ul>
						<li> <a href="{{ route('add.admin')}}"><i class="bx bx-right-arrow-alt"></i>Admin hozzáadása</a>
						</li>					
					</ul>
				
				</li>
		
	
				<li>
					<a href="" target="_blank">
						<div class="parent-icon"><i class='bx bx-cart'></i>
						</div>
						<div class="menu-title">Regisztrált vásárlók</div>
					</a>
				</li>
			</ul>
			<!--end navigation-->
		</div>