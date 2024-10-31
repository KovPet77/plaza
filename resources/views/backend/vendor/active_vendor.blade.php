@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Összes aktív eladó</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Aktív eladók</li>
							</ol>   
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
                          					
					
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
										<th>Üzlet neve</th>
										<th>Üzlet felhasználói neve</th>
										<th>Csatlakozási Dátum</th>									
										<th>Email</th>									
										<th>Státusz</th>									
										<th>Művelet</th>									
									</tr>
								</thead>
								<tbody>
                                    <!-- A CategoryController-ben van kiszedve $categories váltózóban minden
                                    category_name...stb: az atadbázisban az oszlop neve -->
                                    @foreach($ActiveVendor as $key => $item)
									<tr>
										<td>{{$key+1}}</td>
                                        <!-- $item['category'] = a SubCategory model-ben: public function category(). Tehát a funkció neve -->
										<td>{{$item->name}}</td>
										<td>{{$item->username}}</td>
										<td>{{$item->vendor_join}}</td>
										<td>{{$item->email}}</td>
										<td><span class="btn btn-success">{{$item->status}}</span></td>
										<td><a href="{{ route('active.vendor.details',$item->id)}}" class="btn btn-info">Eladó adatai</a>									
									
                                    </td>									
									</tr>
						
                                    @endforeach

								</tbody>
								<tfoot>
								<tr>
                                    <th>Sl</th>
                                    <th>Üzlet neve</th>
                                    <th>Üzlet felhasználói neve</th>
                                    <th>Csatlakozási Dátum</th>									
                                    <th>Email</th>									
                                    <th>Státusz</th>									
                                    <th>Művelet</th>									
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>	
		
			</div>

@endsection