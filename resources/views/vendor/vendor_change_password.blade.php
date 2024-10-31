@extends('vendor.vendor_dashboard')
@section('vendor')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content"> 
					<!--breadcrumb-->
                    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Vendor</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Jelszó változtatás</li>
							</ol>
						</nav>
					</div>
					</div>
                    <!--breadcrumb-->
				<div class="container">
					<div class="main-body">
						<div class="row">
	
							<div class="col-lg-12">
								<div class="card">
									<div class="card-body">

									<form method="POST" action="{{route('vendor.update.password')}}">
										@csrf

                                        @if (session('status'))
                                            <div class="alert alert-success" role="alert">
                                                {{session('status')}}
                                            </div>
                                            @elseif (session('error'))  
                                            <div class="alert alert-danger" role="alert">
                                            {{session('error')}}
                                            </div>
                                            @endif
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Régi jelszó</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input id="current_password" type="password" class="form-control @error('old_password') is-invalid @enderror"  name="old_password" placeholder="Régi jelszó" />
                                                @error('old_password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
											</div>
										</div>

										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Új jelszó</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input id="new_password" type="password" class="form-control" class="form-control @error('new_password') is-invalid @enderror" name="new_password" placeholder="Új jelszó"/>
                                                @error('new_password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
											</div>
										</div>



                                        <div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Új jelszó megerősítése</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input id="new_password_confirmation" type="password" class="form-control" class="form-control" name="new_password_confirmation" placeholder="Új jelszó megerősítése"/>
                                                @error('new_password_confirmation')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
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