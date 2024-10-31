@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content"> 
						<!--breadcrumb-->
						<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Admin</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Admin szerkesztése</li>
							</ol>
						</nav>
					</div>
					</div>
                    <!--breadcrumb-->
				<div class="container">
					<div class="main-body">
						<div class="row">
				
							<div class="col-lg-8">
								<div class="card">
									<div class="card-body">

									<form method="POST" action="{{route('admin.user.update', $user->id )}}" >
										@csrf
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Név</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" name="name" value="{{ $user->name}}" />
											</div>
										</div>		

										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Felhasználó Név</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" name="username"value="{{ $user->username}}" />
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Email</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input  type="email" class="form-control" name="email" value="{{ $user->email }}" />
											</div>
										</div>		

										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Telefon</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" name="phone" value="{{ $user->phone }}"/>
											</div>
										</div>
									
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Cím</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control"  name="address"  value="{{ $user->address }}"/>
											</div>
										</div>			



											<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Szerep szerkesztése</h6>
											</div>
											<div class="col-sm-9 text-secondary">
								<h5 style="color: red;">Jelenlegi szerepe: {{ $user->role}} </h5>	
							<select name="roles" class="form-select mb-3" aria-label="Default select example">
					           <option selected="">Válassz...</option>
					 @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ $user->hasRole($role->name) ? 'selected' : '' }} >{{ $role->name }}</option>
                    @endforeach														
							
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