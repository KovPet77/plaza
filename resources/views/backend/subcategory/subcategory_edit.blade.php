@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content"> 
						<!--breadcrumb-->
						<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Alkategória szerkesztése</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Alkategória szerkesztése</li>
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

									<form method="POST" action="{{route('update.subcategory')}}">
										@csrf
                                        <input type="hidden" name="id"  value="{{$subcategory->id}}"/>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Kategória neve </h6>
											</div>
											<div class="col-sm-9 text-secondary">
                                            <select name="category_id" class="form-select mb-3" aria-label="Default select example">
                                                <option selected="">Válaszd ki a kategóriát</option>
                                                @foreach($categories as $category)
                                                <option value="{{$category->id}}" 
                                                {{ $category->id == $subcategory->category_id ? 'selected' : ''}}>{{$category->category_name}}</option>
                                                @endforeach    
							            	</select>
											</div>
										</div>
					
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Alkategória neve </h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" name="subcategory_name" required  value="{{$subcategory->subcategory_name}}" />
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