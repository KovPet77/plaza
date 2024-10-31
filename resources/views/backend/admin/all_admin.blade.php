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
								<li class="breadcrumb-item active" aria-current="page">Összes admin</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
                            <a href="{{ route('add.admin')}}"  class="btn btn-primary">Admin hozzáadása</a>					
					
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
									
										<th>Fotó</th>
										<th>Név</th>
										<th>Telefon</th>
										<th>Szerep</th>
										<th>Beosztás</th>
										<th>Művelet</th>									
									</tr>
								</thead>
								<tbody>
                                    <!-- A CategoryController-ben van kiszedve $categories váltózóban minden
                                    category_name...stb: az atadbázisban az oszlop neve -->
                                    @foreach($allAdminUser as $key => $item)
									<tr>
										<td>{{$key+1}}</td>
										
										<td>
											<img src="{{ (!empty($item->photo)) ? url('upload/admin_images/'.$item->photo) : url('upload/no_image.jpg') }}" style="width:50px; height:50px;" />
										</td>

										<td>{{ $item->name }}</td>										
										<td>{{ $item->phone }}</td>
										<td>{{ $item->role }}</td>

										<td>
										@foreach($item->roles as $role)
										<span class="badge badge-pill bg-success">{{ $role->name }}</span>
										@endforeach
										</td>


										<td><a href="{{ route('edit.admin.role',$item->id)}}" class="btn btn-info">Szerkesztés</a>									
										<a href="{{ route('delete.admin.role', $item->id)}}" class="btn btn-danger" id="delete">Törlés</a>
                                    </td>									
									</tr>
						
                                    @endforeach

								</tbody>
								<tfoot>
								<tr>
										<th>Sl</th>
										<th>Fotó</th>
										<th>Név</th>
										<th>Telefon</th>
										<th>Szerep</th>
										<th>Beosztás</th>
										<th>Művelet</th>								
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>	
		
			</div>

@endsection