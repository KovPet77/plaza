@extends('dashboard') 
@section('user')
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


  <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Kezdőlap</a>
                    <span></span>Rendelés nyomonkövetése
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
            <h5>Rendelésed nyomonkövetése</h5>
        </div>
        <div class="card-body">



    <form method="post" action="{{ route('order.tracking') }}" > 
            @csrf

       


<div class="row">

    <div class="form-group col-md-12">
        <label>Számla kódja<span class="required">*</span></label>
        <input  class="form-control" name="code" type="text"  placeholder="A rendelésed számla száma..." required="" />

    </div>

 

    <div class="col-md-12">
        <button type="submit" class="btn btn-fill-out submit font-weight-bold" name="submit" value="Submit">Keresés</button>
    </div>
</div>
            </form>
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