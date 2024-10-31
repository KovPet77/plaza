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
								<li class="breadcrumb-item active" aria-current="page">Rendelések adatai</li>
							</ol>
						</nav>
					</div>
				
				</div>
				<!--end breadcrumb-->
				
				<hr/>
	<div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-2">
					<div class="col">
			      <div class="card">
                <div class="card-header"><h4>Szállítási információk</h4></div>
                <hr>

                <div class="card-body">
                    <table class="table" style="background:#ddd; font-weight:600;">
                        <tr>
                            <th>Megrendelő neve:</th>
                            <th>{{ $order->name }}</th>
                        </tr>
                        <tr>
                            <th>Email:</th>
                             <th>{{ $order->email }}</th>
                        </tr>
                        <tr>
                            <th>Cím:</th>
                            <th>{{ $order->address }}</th>
                        </tr>
                        <tr>
                            <th>Irányítószám:</th>
                            <th>{{ $order->post_code }}</th>
                        </tr>
                        <tr>
                            <th>Telefonszám:</th>
                            <th>{{ $order->phone }}</th>
                        </tr>

                        <tr>
                            <th>Dátum:</th>
                            <th>{{ $order->order_date }}</th>
                        </tr>                  
                    </table>
                </div>
            </div> 
					</div>
					<div class="col">
	            <div class="card">
                <div class="card-header"><h4>Rendelés adatai</h4>

                    <span class="text-danger">Számla: {{ $order->invoice_no }}</span>
                </div>
                <hr>

                <div class="card-body">
                    <table class="table" style="background:#ddd; font-weight:600;">
                        <tr>
                            <th>Megrendelő neve:</th>
                            
                            @if(isset($order->user->name))

                            <th> {{$order->user->name}}</th>

                            @else                            
                            <th> {{$order->name}}</th>

                            @endif
                        </tr>
                        <tr>
                            <th>Telefon:</th>
                            @if(isset($order->user->name))
                            
                            <th>{{ $order->user->phone }}</th>

                            @else                            
                            <th>{{ $order->phone }}</th>

                            @endif





                        </tr>
                        <tr>
                            <th>Fizetési mód:</th>
                            <th>{{ $order->payment_method }}</th>
                        </tr>
                        <tr>
                            <th>Tranzakció ID:</th>
                  	          <th>{{ $order->transaction_id }}</th>
                        </tr>
                        <tr>
                            <th>Számla:</th>
                            <th class="text-danger">{{ $order->invoice_no}}</th>
                        </tr>
                        <tr>
                            <th>Összeg</th>
                            <th>{{ $order->amount }}</th>
                        </tr>
                        <tr>
                            <th>Rendelés státusza:</th>
                            <th> <span class="badge rounded-pill bg-danger" style="font-size:15px;">{{ $order->status }}</span>
                            </th>
                        </tr>   


                    </table>
                </div>
            </div>    
					</div>
				</div>





					<div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-1">
					<div class="col">
						<div class="card">
			                    <div class="table-responsive">
                        <table class="table" style="font-weight: 600;">
                            <tbody>
                                <tr>
                                    <td class="col-md-1">
                                        <label>Fotó</label>
                                    </td>
                                    <td class="col-md-2">
                                        <label>Termék neve</label>
                                    </td>
                                    <td class="col-md-2">
                                        <label>Eladó neve</label>
                                    </td>
                                    <td class="col-md-2">
                                        <label>Termék kód</label>
                                    </td>
                                    <td class="col-md-1">
                                        <label>Szín</label>
                                    </td>
                                    <td class="col-md-1">
                                        <label>Méret</label>
                                    </td>
                                    <td class="col-md-1">
                                        <label>Darabszám</label>
                                    </td>
                                    <td class="col-md-3">
                                        <label>Ár</label>
                                    </td>
                                </tr>

                                @foreach($orderItem as $item)
                                 <tr>
                                    <td class="col-md-1">
                                        <label><img src="{{ asset($item->product->product_thumbnail )}}" style="width:50px; height: 50px;"></label>
                                    </td>
                                    <td class="col-md-2">
                                        <label>{{ $item->product->product_name }}</label>
                                    </td>

                                    @if($item->vendor_id == NULL)
                                    <td class="col-md-2">
                                        <label>Pláza tulajdonosa</label>
                                    </td>
                                    @else
                                     <td class="col-md-2">
                                        <!-- Ez a vendor speciel a Product model-ből jön, ott van egy belongsto()-->
                                        <label>{{ $item->product->vendor->name}}</label>
                                    </td>
                                    @endif

                                    <td class="col-md-2">
                                        <label>{{ $item->product->product_code }}</label>
                                    </td>

                                    @if($item->color == NULL)
                                     <td class="col-md-1">
                                        <label>...</label>
                                    </td>
                                    @else
                                     <td class="col-md-1">
                                        <label>{{ $item->color }}</label>
                                    </td>
                                    @endif
                                  
                                     @if($item->size == NULL)
                                     <td class="col-md-1">
                                        <label>...</label>
                                    </td>
                                    @else
                                     <td class="col-md-1">
                                        <label>{{ $item->size }}</label>
                                    </td>
                                    @endif


                                    
                                    <td class="col-md-1">
                                        <label>{{ $item->qty }}</label>
                                    </td>
                                    <td class="col-md-3">
                                        <label>{{ $item->price }} <br> Végösszeg = {{ $item->price * $item->qty }} Ft. </label>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
						</div>
					</div>
	
				</div>
		
			</div>

@endsection