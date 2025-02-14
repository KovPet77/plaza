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
								<li class="breadcrumb-item active" aria-current="page">Szerep hozzáadása jogosultsághoz</li>
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

									<form method="POST" action="{{route('admin.roles.update', $role->id)}}">
										@csrf
					
										<div class="row mb-3">
											<div class="col-sm-3">
											 <h6 class="mb-0">Szerep neve </h6>
										</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="name" value="{{ $role->name }}">
								</div>

                                <div class="row">
									<div class="col-3">	
                                <div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultAll">
									<label class="form-check-label" for="flexCheckDefaultAll">Összes jogosltság</label>
								</div>
								</div>
								</div>

								<hr>

								@foreach($permission_groups as $group)
								<div class="row">
									<div class="col-3">							
	                                    @php
										$permissions = App\Models\User::getPermissionByGroupName($group->group_name);
										@endphp
								   <div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"
									{{ App\Models\User::roleHasPermissions($role, $permissions) ? 'checked' : ''}}>


			<label class="form-check-label" for="flexCheckDefault">{{ $group->group_name }}
			</label>
								</div>
									</div>


									<div class="col-9">
									

									@foreach($permissions as $permission)	
								    <div class="form-check">
									<input class="form-check-input" name="permission[]" {{ $role->hasPermissionTo($permission->name) ? 'checked' : ''}} type="checkbox" value="{{ $permission->id }}" id="flexCheckDefault {{ $permission->id }}" >
									<label class="form-check-label" for="flexCheckDefault {{ $permission->id }} ">{{ $permission->name }}</label>
								   </div>
									@endforeach	


									</div>
								</div>	
								@endforeach



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

<script>
	
	$('#flexCheckDefaultAll').click(function(){

		if ($(this).is(':checked')) {

			$('input[type = checkbox]').prop('checked', true);

		}else{

			$('input[type = checkbox]').prop('checked', false);
		}
	})
</script>

@endsection