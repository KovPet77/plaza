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
								<li class="breadcrumb-item active" aria-current="page">Összes kupon</li>
							</ol>   
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
                            <a href="{{ route('add.coupon')}}"  class="btn btn-primary">Kupon hozzáadása</a>					
					
						</div>
					</div>
				</div>
				<!--end breadcrumb-->
				
				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>Sl</th>
										<th>Kupon neve</th>
										<th>Kupon diszkont</th>
										<th>Kupon érvényesség</th>
										<th>Kupon státusz</th>
										<th>Művelet</th>									
									</tr>
								</thead>
								<tbody>
                                    <!-- A CategoryController-ben van kiszedve $categories váltózóban minden
                                    category_name...stb: az atadbázisban az oszlop neve -->
                                    @foreach($coupon as $key => $item)
									<tr>
										<td>{{$key+1}}</td>
                                        <!-- $item['category'] = a SubCategory model-ben: public function category(). Tehát a funkció neve -->
										<td>{{ $item->coupon_name }}</td>
										<td>{{ $item->coupon_discount }} %</td>
										<td>{{ Carbon\Carbon::parse($item->coupon_validity)->format('D, d F Y')}}</td>


					<td>
						
						@if($item->coupon_validity >= Carbon\Carbon::now()->format('Y-m-d'))

						<span class="badge rounded-pill bg-success">Érvényes</span>

						@else

						<span class="badge rounded-pill bg-danger">Lejárt/Érvénytelen</span>

						@endif

					</td>



				<td><a href="{{ route('edit.coupon', $item->id)}}" class="btn btn-info">Szerkesztés</a>									
				<a href="{{ route('delete.coupon', $item->id)}}" class="btn btn-danger" id="delete">Törlés</a>
            </td>										
			</tr>
						
                                    @endforeach

								</tbody>
								<tfoot>
								<tr>
								<th>Sl</th>
										<th>Kupon neve</th>
										<th>Kupon diszkont</th>
										<th>Kupon érvényesség</th>
										<th>Kupon státusz</th>
										<th>Művelet</th>									
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>	
		
			</div>

@endsection