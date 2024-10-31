@extends('vendor.vendor_dashboard')
@section('vendor')
<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Admin</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Függőben lévő rendelések</li>
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
										<th>Cím</th>									
										<th>Státusz</th>									
										<th>Művelet</th>									
									</tr>
								</thead>
								<tbody>
                              
                                    @foreach($orderItem as $key => $item)
									<tr>
										<td>{{$key+1}}</td>
										<td>{{ $item['order']['order_date'] }}</td>
										<td>{{ $item['order']['invoice_no'] }}</td>
										<td>{{ $item['order']['amount'] }} Ft.</td>
										<td>{{ $item['order']['payment_method'] }}</td>
										<td>{{ $item['order']['order_date'] }}</td>
								
										<td><span class="badge rounded-pill bg-success">{{$item['order']['status']}}</span></td>


               							<!-- $item->order->id: VendorOrderController-ben, illetve a Model-ekben már meg vannak határozva a relationship, order néven... A lényeg, hogy az Order table id-ja kell-->		
										<td><a href="{{ route('vendor.order.details',$item->order->id)}}" class="btn btn-info" title="Megtekintés"><i class="fa fa-eye"></i></a>
                                    </td>									
									</tr>
						
                                    @endforeach

								</tbody>
								<tfoot>
								<tr>
								<th>Sl</th>
										<th>Dátum</th>
										<th>Számla</th>
										<th>Összeg</th>									
										<th>Fizetési mód</th>									
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