@extends('dashboard')
@section('user')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href=" {{ route('/')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Kezdőlap</a>
                    <span></span>  <span></span> Irányítópult
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
                                                <h3 class="mb-0">Hello {{Auth::user()->name}}</h3>
                                                <img id="showImage2" src="{{ (!empty($userData->photo)) ? url('upload/user_images/'.$userData->photo) : url('upload/no_image.jpg') }}" 
											alt="Admin"  style="width: 100px; height: 100px;">
                                            </div>
                                            <div class="card-body">
                                             @if(Auth::user()->role != 'user')
                                                <p>
                                                    <a href="{{ url('vendor/dashboard')}}">Eladói irányítópult</a>
                                                    <br />
                                                
                                                </p>
                                             @endif
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

        <script>
				$(document).ready(function(){
					$("#image").change(function(e){
						var reader = new FileReader();
						reader.onload = function(e){
							$("#showImage").attr('src', e.target.result);
						}

						reader.readAsDataURL(e.target.files['0'])
					})
				});
			</script>
                    <script>
				$(document).ready(function(){
					$("#image2").change(function(e){
						var reader = new FileReader();
						reader.onload = function(e){
							$("#showImage").attr('src', e.target.result);
						}

						reader.readAsDataURL(e.target.files['0'])
					})
				});
			</script>
        @endsection