@extends('dashboard') 
@section('user')
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Kezdőlap</a>
                    <span></span> Rendeléseim
                </div>
            </div>
        </div>
        <div class="page-content pt-50 pb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 m-auto">
<div class="row">



 @include('frontend.body.dashboard_sidebar_menu')


<div class="col-md-9">
<div class="tab-content account dashboard-content pl-50">
<div class="tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
    <div class="card">
        <div class="card-header">
            <h3 class="mb-0">Rendeléseid</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" style="background: #ddd; font-weight:600;">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Dátum</th>
                            <th>Összeg</th>
                            <th>Fizetési mód</th>
                            <th>Számla</th>
                            <th>Státusz</th>
                            <th>Művelet</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $key => $order)
                        <tr>
                            <td>{{ $key+1}}</td>
                            <td>{{ $order->order_date}}</td>
                            <td>{{ $order->amount}}</td>
                            <td>{{ $order->payment_method}}</td>
                            <td>{{ $order->invoice_no}}</td>
                            <td>
                                
                             @if($order->status == 'pending')

                             <span class="badge rounded-pill bg-warning">Függőben</span>

                             @elseif($order->status == 'confirm')   
                             <span class="badge rounded-pill bg-info">Megerősítve</span>
                               @elseif($order->status == 'processing')   
                             <span class="badge rounded-pill bg-dark">Folyamatban</span>
                               @elseif($order->status == 'delivered')   
                             <span class="badge rounded-pill bg-success">Szállítva</span>
                             @endif   

                             @if($order->return_order)
                             <span class="badge rounded-pill" style="background:red;">Visszaküldés alatt</span>
                             @endif
                            </td>
                            
                            <td>
                            <a href="{{ url('user/order_details/'.$order->id) }}" class="btn-sm btn-success"><i class="fa fa-eye"></i> Megtekintés</a>
                            <a href="{{ url('user/invoice_download/'.$order->id)}}" class="btn-sm btn-danger"><i class="fa fa-download"></i>Számla</a>
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
   </div>





                        </div>
                    </div>
                </div>
            </div>
        </div>




@endsection