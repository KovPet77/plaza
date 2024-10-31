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
								<li class="breadcrumb-item active" aria-current="page">Összes slider</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
                            <a href="{{ route('add.slider')}}"  class="btn btn-primary">Slider hozzáadása</a>					
					
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
										<th>Slider neve</th>
										<th>Rövid cím</th>
										<th>Slider fotó</th>
										<th>Művelet</th>									
									</tr>
								</thead>
								<tbody>
                                    <!-- A CategoryController-ben van kiszedve $categories váltózóban minden
                                    category_name...stb: az atadbázisban az oszlop neve -->
                                    @foreach($sliders as $key => $item)
									<tr>
										<td>{{$key+1}}</td>
										<td>{{$item->slider_title}}</td>
										<td>{{$item->short_title}}</td>
										<td><img src="{{asset($item->slider_image)}}" style="width:70px; height:40px;" /></td>
										<td><a href="{{ route('edit.slider',$item->id)}}" class="btn btn-info">Szerkesztés</a>									
										<a href="{{ route('delete.slider', $item->id)}}" class="btn btn-danger" id="delete">Törlés</a>
                                    </td>									
									</tr>
						
                                    @endforeach

								</tbody>
								<tfoot>
								<tr>
                                <th>Sl</th>
										<th>Slider neve</th>
										<th>Rövid cím</th>
										<th>Slider fotó</th>
										<th>Művelet</th>								
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>	
		
			</div>

@endsection