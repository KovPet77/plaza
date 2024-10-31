@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Admin</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Jelentések</li>
							</ol>
						</nav>
					</div>
				
				</div>
				<!--end breadcrumb-->
				
				<hr/>
			<div class="row row-cols-1 row-cols-md-1 row-cols-lg-3 row-cols-xl-3">

				<form method="post" action="{{ route('search-by-date')}}">
					@csrf
					<div class="col">
						<div class="card">
							
							<div class="card-body">
								<h5 class="card-title">Keresés dátum alapján</h5>
								<label class="form-label">Dátum:</label>

								<input type="date" name="date" class="form-control">
								<br>
								<input type="submit" class="btn btn-rounded btn-primary" value="Keresés">
							</div>
						
							
						</div>
					</div>
                    </form>


				<form method="post" action="{{ route('search-by-month')}}">
					@csrf
					<div class="col">
						<div class="card">
							
							<div class="card-body">
								<h5 class="card-title">Keresés hónap-év alapján</h5>
								<label class="form-label">Hónap választása:</label>
                           <select name="month" class="form-select mb-3" aria-label="Default select example">
									<option selected="">Hónap választása</option>
									<option value="January">Január</option>
									<option value="February">Február</option>
									<option value="March">Március</option>
									<option value="April">Április</option>
									<option value="May">Május</option>
									<option value="June">Június</option>
									<option value="July">Július</option>
									<option value="August">Augusztus</option>
									<option value="September">Szeptember</option>
									<option value="October">Október</option>
									<option value="November">November</option>
									<option value="December">December</option>
						   </select>

						<label class="form-label">Év:</label>
                           <select name="year_name" class="form-select mb-3" aria-label="Default select example">
									<option selected="">Év választása</option>
									<option value="2022">2022</option>
									<option value="2023">2023</option>
									<option value="2024">2024</option>
									<option value="2025">2025</option>
						   </select>
							
								<br>
								<input type="submit" class="btn btn-rounded btn-primary" value="Keresés">
							</div>
						
							
						</div>
					</div>
                    </form>



                   <form method="post" action="{{ route('search-by-year')}}">
					@csrf
					<div class="col">
						<div class="card">
							
							<div class="card-body">
								<h5 class="card-title">Keresés év alapján</h5>
					

						<label class="form-label">Év választása:</label>
                           <select name="year" class="form-select mb-3" aria-label="Default select example">
									<option selected="">Válassz évet</option>
									<option value="2022">2022</option>
									<option value="2023">2023</option>
									<option value="2024">2024</option>
									<option value="2025">2025</option>
						   </select>
							
								<br>
								<input type="submit" class="btn btn-rounded btn-primary" value="Keresés">
							</div>
						
							
						</div>
					</div>
                    </form>








				</div>
		
			</div>

@endsection