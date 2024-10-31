@extends('vendor.vendor_dashboard')
@section('vendor')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content"> 
						<!--breadcrumb-->
						<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Eladó</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Inaktív Eladó Profil</li>
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

									<form method="POST" action="{{ route('active.vendor.approve') }}" >
										@csrf
                                        <input type="hidden" name="id" value="{{$inActiveVendorDetails->id}}"/>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Felhasználó név</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" name="username" value="{{$inActiveVendorDetails->username}}"  />
											</div>
										</div>

                                        <div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Vendor Üzlet Neve</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" name="name" value="{{$inActiveVendorDetails->name}}"  />
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Üzlet Email</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" type="email" class="form-control" name="email" value="{{$inActiveVendorDetails->email}}" />
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Üzlet Telefon</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" name="phone" value="{{$inActiveVendorDetails->phone}}" />
											</div>
										</div>
									
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Üzlet Cím</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control"  name="address" value="{{$inActiveVendorDetails->address}}" />
											</div>
										</div>

                                        <div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Üzlet csatlakozási dátuma</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control"  name="vendor_join" value="{{$inActiveVendorDetails->vendor_join}}" />
											</div>
										</div>


                                        <div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Üzlet Info</h6>
											</div>
											<div class="col-sm-9 text-secondary">
                                            <textarea name="vendor_short_info" class="form-control" id="inputAddress4" rows="3" placeholder="Cím">
                                            {{$inActiveVendorDetails->vendor_short_info}}
                                            </textarea>
											</div>
										</div>

										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Üzlet Fotó</h6>
											</div>
											<div class="col-sm-9 text-secondary">
                                            <img id="showImage" src="{{ (!empty($inActiveVendorDetails->photo)) ? url('upload/vendor_images/'.$inActiveVendorDetails->photo) : url('upload/no_image.jpg') }}" 
											alt="Vendor"  style="width: 100px; height: 100px;">
											</div>
										</div>						


										<div class="row">
											<div class="col-sm-3"></div	>
											<div class="col-sm-9 text-secondary">
												<input type="submit" class="btn btn-danger px-4" value="Üzlet Aktiválása" />
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