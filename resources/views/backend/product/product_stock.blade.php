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
								<li class="breadcrumb-item active" aria-current="page">Készlet</li>
							</ol>
						</nav>
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
										<th>Fotó</th>
										<th>Termék neve</th>
										<th>Ár</th>									
										<th>Készlet</th>									
										<th>Diszkont</th>									
										<th>Státusz</th>									
																			
									</tr>
								</thead>
								<tbody>
                                    <!-- A CategoryController-ben van kiszedve $categories váltózóban minden
                                    category_name...stb: az atadbázisban az oszlop neve -->
                                    @foreach($product as $key => $item)
									<tr>
										<td>{{$key+1}}</td>										
										<td><img src="{{asset($item->product_thumbnail)}}" style="width:70px; height:40px;" /></td>
										<td>{{$item->product_name}}</td>										
										<td>{{$item->selling_price}}</td>										
										<td>{{$item->product_qty}} db.</td>										
										<td>


										@if($item->discount_price == NULL)
										<span class="badge rounded-pill bg-info">Nincs diszkont</span>
										@else
										
										@php
										$amount = $item->selling_price - $item->discount_price;
										$discount = ($amount/$item->selling_price) * 100;	
										@endphp
										<span class="badge rounded-pill bg-danger"> {{ round($discount) }} % </span>						

										@endif											
										
										</td>										
										<td>

										@if($item->status == 1)
										<span class="badge rounded-pill bg-success">Aktív</span>
										@else
										<span class="badge rounded-pill bg-danger">Inaktív</span>
										@endif

										</td>	

												
									</tr>
						
                                    @endforeach

								</tbody>
								<tfoot>
								<tr>
								<th>Sl</th>
										<th>Fotó</th>
										<th>Termék neve</th>
										<th>Ár</th>									
										<th>Készlet</th>									
										<th>Diszkont</th>									
										<th>Státusz</th>									
																				
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>	
		
			</div>

@endsection