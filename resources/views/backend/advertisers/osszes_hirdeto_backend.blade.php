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
								<li class="breadcrumb-item active" aria-current="page">Összes hirdető <span class="badge rounded-pill bg-danger">{{ count($hirdetok)}}</span></li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
                            <a href="{{ url('hirdeto/hozzadas') }}"  class="btn btn-primary">Hirdető hozzáadása</a>					
					
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
										<th>Hirdető neve</th>
																	
										<th>Státusz</th>									
										<th>Művelet</th>									
									</tr>
								</thead>
								<tbody>

    @foreach($hirdetok as $key => $item)
	<tr>
		<td>{{$key+1}}</td>				
		    <!-- Ez volt itt előzőleg!!!
				<td><img src="{{asset('upload/advertiser_images/'.$item->photo)}}" style="width:70px; height:40px;" /></td>
				-->
				
		<td><img src="{{$item->photo}}" style="width:70px; height:40px;" /></td>
		<td>{{$item->name}}</td>
												
		<td>

		@if($item->status == 'active')
		<span class="badge rounded-pill bg-success">Aktív</span>
		@else
		<span class="badge rounded-pill bg-danger">Inaktív</span>
		@endif

		</td>	

	<td>
	<a href="{{ route('hirdeto.szerkesztes',$item->id)}}" class="btn btn-info" title="Szerkesztés"><i class="fa fa-pencil"></i></a>									
	<a href="{{ route('delete.product', $item->id)}}" class="btn btn-danger" id="delete" title="Törlés"><i class="fa fa-trash"></i></a>

			
			@if($item->status == 1)
			<a href="{{-- route('product.inactive',$item->id) --}}" class="btn btn-primary" title="Inaktiválás"><i class="fa-solid fa-thumbs-down"></i></a>
			
			@else
			<a href="{{-- route('product.active',$item->id) --}}" class="btn btn-primary" title="Aktiválás"><i class="fa-solid fa-thumbs-up"></i></a>


			@endif
                </td>									
				</tr>
	
                @endforeach

			</tbody>
			<tfoot>
			<tr>
			<th>Sl</th>
					<th>Fotó</th>
					<th>Hirdető neve</th>
											
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