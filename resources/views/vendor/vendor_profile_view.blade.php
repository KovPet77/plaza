@extends('vendor.vendor_dashboard')
@section('vendor')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content"> 
						<!--breadcrumb-->
						<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Üzlet</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Profil</li>
							</ol>
						</nav>
					</div>
					</div>
                    <!--breadcrumb-->
				<div class="container">
					<div class="main-body">
						<div class="row">
							<div class="col-lg-4">
								<div class="card">
									<div class="card-body">
										<div class="d-flex flex-column align-items-center text-center">
											<img src="{{ (!empty($vendordata->photo)) ? url('upload/vendor_images/'.$vendordata->photo) : url('upload/no_image.jpg') }}" alt="Vendor" class="rounded-circle p-1 bg-primary" width="110">
											<div class="mt-3">
												<h4>{{$vendordata->name}}</h4>
										
												<!-- <button class="btn btn-primary">Follow</button>
												<button class="btn btn-outline-primary">Message</button> -->
											</div>
										</div>
										<hr class="my-4" />
										<ul class="list-group list-group-flush">
							
							
										</ul>
									</div>
								</div>
							</div>
							<div class="col-lg-8">
								<div class="card">
									<div class="card-body">

									<form method="POST" action="{{route('vendor.profile.store')}}" enctype="multipart/form-data">
										@csrf
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Üzlet Neve</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" name="name" value="{{$vendordata->name}}"  />
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Üzlet Email</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" type="email" class="form-control" name="email" value="{{$vendordata->email}}" />
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Üzlet Telefon</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" name="phone" value="{{$vendordata->phone}}" />
											</div>
										</div>
									
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Üzlet Cím</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control"  name="address" value="{{$vendordata->address}}" />
											</div>
										</div>

                                        <div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Csatlakozási Dátum</h6>
											</div>
											<div class="col-sm-9 text-secondary">
                                            <select name="vendor_join" class="form-select mb-3" aria-label="Default select example">
                                                <option selected>Open this select menu</option>                                               
                                                <option value="2023" {{ $vendordata->vendor_join == 2023 ? 'selected' : ''}}>2023</option>
                                                <option value="2024"  {{ $vendordata->vendor_join == 2024 ? 'selected' : ''}}>2024</option>
                                                <option value="2025"  {{ $vendordata->vendor_join == 2025 ? 'selected' : ''}}>2025</option>
                                                <option value="2026"  {{ $vendordata->vendor_join == 2026 ? 'selected' : ''}}>2026</option>
							            	</select>
											</div>
										</div>


                                        <div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Üzlet Info</h6>
											</div>
											<div class="col-sm-9 text-secondary">
                                            <textarea name="vendor_short_info" class="form-control" id="inputAddress4" rows="3" placeholder="Cím">
                                            {{$vendordata->vendor_short_info}}
                                            </textarea>
											</div>
										</div>

										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Fotó</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="file" class="form-control" name="photo" id="image" />
											</div>
										</div>

										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Előnézet</h6>
											</div>
											<div class="col-sm-9 text-secondary">
											<img id="showImage" src="{{ (!empty($vendordata->photo)) ? url('upload/vendor_images/'.$vendordata->photo) : url('upload/no_image.jpg') }}" 
											alt="Vendor"  style="width: 100px; height: 100px;">
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


			<script>
				$(document).ready(function(){
					$("#image").change(function(e){
						var reader = new FileReader();
						reader.onload = function(e){
							$("#showImage").attr('src', e.target.result);
						}

						reader.readAsDataURL(e.target.files['0'])
					})
				});
			</script>
@endsection