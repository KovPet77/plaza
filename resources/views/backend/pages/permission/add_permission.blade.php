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
								<li class="breadcrumb-item active" aria-current="page">Jogosultság hozzáadása</li>
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

									<form method="POST" action="{{route('store.permission')}}">
										@csrf
					
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Jogosultság neve </h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" name="name" required  />
											</div>
										</div>		



									<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Jogosultság csoport </h6>
											</div>
											<div class="col-sm-9 text-secondary">
								 <select name="group_name" class="form-select mb-3" aria-label="Default select example">
									<option selected="">Válassz csoportot</option>
									<option value="márka">Márka</option>
									<option value="kategória">Kategória</option>
									<option value="alkategória">Alkategória</option>
									<option value="termék">Termék</option>
									<option value="sLider">SLider</option>
									<option value="ads">Ads</option>
									<option value="kupon">Kupon</option>
									<option value="area">Area</option>
									<option value="eladó">Eladó</option>
									<option value="rendelés">Rendelés</option>
									<option value="termék visszaküldés">Termék visszaküldés</option>
									<option value="jelentés">Jelentés</option>
									<option value="felhasználó">Felhasználó kezelése</option>
									<option value="vélemények">Vélemények</option>
									<option value="beállítások">Beállítások</option>
									<option value="role">Role</option>
									<option value="admin">Admin</option>
									<option value="raktár">Raktár</option>
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