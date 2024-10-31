@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content"> 
						<!--breadcrumb-->
						<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Kategória</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Jogosultság szerkesztése</li>
							</ol>
						</nav>
					</div>
					</div>
                    <!--breadcrumb-->
				<div class="container">
					<div class="main-body">
						<div class="row">
						
							<div class="col-lg-10">
								<div class="card">
									<div class="card-body">

									<form method="POST" action="{{route('update.permission')}}">
										@csrf
						<input type="hidden" name="id" value="{{ $permission->id }}">
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Jogosultság neve </h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input value="{{ $permission->name }}" type="text" class="form-control" name="name" required  />
											</div>
										</div>		



									<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Jogosultság csoport </h6>
											</div>
											<div class="col-sm-9 text-secondary">
	 <select name="group_name" class="form-select mb-3" aria-label="Default select example">
		<option selected="">Válassz csoportot</option>
		<option value="márka" {{ $permission->group_name == 'márka' ? 'selected' : '' }}>Márka</option>
		<option value="kategória" {{ $permission->group_name == 'kategória' ? 'selected' : '' }} >Kategória</option>
		<option value="alkategória" {{ $permission->group_name == 'alkategória' ? 'selected' : '' }} >Alkategória</option>
		<option value="termék" {{ $permission->group_name == 'termék' ? 'selected' : '' }} >Termék</option>
		<option value="sLider" {{ $permission->group_name == 'sLider' ? 'selected' : '' }} >SLider</option>
		<option value="ads" {{ $permission->group_name == 'ads' ? 'selected' : '' }} >Ads</option>
		<option value="kupon" {{ $permission->group_name == 'kupon' ? 'selected' : '' }} >Kupon</option>
		<option value="area" {{ $permission->group_name == 'area' ? 'selected' : '' }} >Area</option>
		<option value="eladó" {{ $permission->group_name == 'eladó' ? 'selected' : '' }} >Eladó</option>
		<option value="rendelés" {{ $permission->group_name == 'rendelés' ? 'selected' : '' }} >Rendelés</option>
		<option value="termék_visszaküldés" {{ $permission->group_name == 'termék_visszaküldés' ? 'selected' : '' }} >Termék visszaküldés</option>
		<option value="jelentés" {{ $permission->group_name == 'jelentés' ? 'selected' : '' }} >Jelentés</option>
		<option value="felhasználó" {{ $permission->group_name == 'felhasználó' ? 'selected' : '' }} >Felhasználó kezelése</option>
		<option value="vélemények" {{ $permission->group_name == 'vélemények' ? 'selected' : '' }} >Vélemények</option>
		<option value="beállítások" {{ $permission->group_name == 'beállítások' ? 'selected' : '' }} >Beállítások</option>
		<option value="role" {{ $permission->group_name == 'role' ? 'selected' : '' }} >Role</option>
		<option value="admin" {{ $permission->group_name == 'admin' ? 'selected' : '' }} >Admin</option>
		<option value="raktár" {{ $permission->group_name == 'raktár' ? 'selected' : '' }} >Raktár</option>
	</select>
											</div>
										</div>
                        



										<div class="row">
											<div class="col-sm-3"></div	>
											<div class="col-sm-9 text-secondary">
												<input type="submit" class="btn btn-primary px-4" value="Változások mentése" />
											</div>
										</div>
									</div>
									</form>
								</div>						
							</div>
						</div>
					</div>
				</div>
			</div>


@endsection