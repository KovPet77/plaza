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
								<li class="breadcrumb-item active" aria-current="page">Összes üzlet</li>
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
										<th>Fotó</th>
										<th>Név</th>
										<th>Email</th>
										<th>Telefon</th>
										<th>Státusz</th>
										<th>Művelet</th>									
									</tr>
								</thead>
			<tbody>
            
                @foreach($vendors as $key => $item)
				<tr>
					<td>{{$key+1}}</td>                                   
					<td><img src="{{ (!empty($item->photo)) ? url('upload/vendor_images/'.$item->photo) : url('upload/no_image.jpg') }}" 
						alt="" width="60" height="60"></td>
					<td>{{$item->name}}</td>
					<td>{{$item->email}}</td>
					<td>{{$item->phone}}</td>
					<td><span class="badge badge-pill bg-success">{{ $item->status }}</span></td>




					<td><a href="{{ route('edit.subcategory',$item->id)}}" class="btn btn-info">Szerkesztés</a>									
					<a href="{{ route('delete.subcategory', $item->id)}}" class="btn btn-danger" id="delete">Törlés</a>
                </td>									
				</tr>
	
                @endforeach

			</tbody>
								<tfoot>
								<tr>
									    <th>Sl</th>
										<th>Fotó</th>
										<th>Név</th>
										<th>Email</th>
										<th>Telefon</th>
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