@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content"> 
						<!--breadcrumb-->
						<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Kategória szerkesztése</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Kategória szerkesztése</li>
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

									<form method="POST" action="{{ route('update.category')}}" enctype="multipart/form-data">
										@csrf
                                        <input  type="hidden" name="id" value="{{ $category->id }}"/>
                                        <input  type="hidden" name="old_image" value="{{$category->category_image}}"/>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Kategória neve </h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" name="category_name" required value="{{ $category->category_name}}"  />
											</div>
										</div>
				

										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Kategória Fotó</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="file" class="form-control" name="category_image" id="image" />
											</div>
										</div>

										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Előnézet</h6>
											</div>
											<div class="col-sm-9 text-secondary">
											<img id="showImage" src="{{ asset($category->category_image) }}" 
											alt="Admin"  style="width: 100px; height: 100px;">
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