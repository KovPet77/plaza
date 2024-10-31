@extends('vendor.vendor_dashboard')
@section('vendor')
<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Üzlet</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Visszaküldött rendelések teljesítése</li>
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
										<th>Dátum</th>
										<th>Számla</th>
										<th>Összeg</th>									
										<th>Fizetési mód</th>									
										<th>Visszaküldés oka</th>									
										<th>Cím</th>									
										<th>Státusz</th>									
										<th>Művelet</th>									
									</tr>
								</thead>
								<tbody>
                                    <!-- Az OrderItem Controller-ben vannak meghatározva a realations-ök -->
                                    @foreach($orderItem as $key => $item)

                                    @if($item->order->return_order == 2)                                
									<tr>
										<td>{{$key+1}}</td>
										<td>{{ $item['order']['order_date'] }}</td>
										<td>{{ $item['order']['invoice_no'] }}</td>
										<td>{{ $item['order']['amount'] }} Ft.</td>
										<td>{{ $item['order']['payment_method'] }}</td>
										<td>{{ $item['order']['return_reason'] }}</td>
										<td>{{ $item['order']['order_date'] }}</td>
								
										@if($item->order->return_order == 1)

	                                   <td><span class="badge rounded-pill bg-danger">Return</span></td>
										@else
	                                   <td><span class="badge rounded-pill bg-success">Visszaküldött</span></td>

										@endif


									
								
										<td><a href="{{ route('vendor.order.details', $item->order->id )}}" class="btn btn-info" title="Megtekintés"><i class="fa fa-eye"></i></a>
                                    </td>									
									</tr>   

									@else

                                    @endif



                                    @endforeach

								</tbody>
								<tfoot>
								<tr>
								<th>Sl</th>
										<th>Dátum</th>
										<th>Számla</th>
										<th>Összeg</th>									
										<th>Fizetési mód</th>									
										<th>Visszaküldés oka</th>									
										<th>Cím</th>									
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