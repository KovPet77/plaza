@extends('dashboard')
@section('user')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ url('/')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Kezdőlap</a>
                    <span></span>  <span></span> Felhasználói fiók
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
                                                <h5>Fiók Adatai</h5>
                                            </div>
                                            <div class="card-body">
                                                <!-- <p>Already have an account? <a href="page-login.html">Log in instead!</a></p> -->
                 <form method="POST" action="{{route('user.profile.store')}}" enctype="multipart/form-data">
                 @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Felhasználó Név <span class="required">*</span></label>
                                <input class="form-control" name="username" type="text" value="{{$userData->username}}" />
                            </div>
                            <div class="form-group col-md-6">
                                <label>Teljes Név <span class="required">*</span></label>
                                <input class="form-control" name="name" value="{{$userData->name}}" />
                            </div>
                            <div class="form-group col-md-12">
                                <label>Email <span class="required">*</span></label>
                                <input class="form-control" name="email" type="text"  value="{{$userData->email}}"/>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Telefon <span class="required">*</span></label>
                                <input class="form-control" name="phone" type="text" value="{{$userData->phone}}" />
                            </div>
                            <div class="form-group col-md-12">
                                <label>Cím <span class="required">*</span></label>
                                <input class="form-control" name="address" value="{{$userData->address}}"/>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Fotó <span class="required">*</span></label>
                                <input  class="form-control" name="photo" value="{{$userData->photo}}" type="file" id="image"/>
                            </div>

                            <div class="form-group col-md-12">
                                <label> <span class="required">*</span></label>
                                <img id="showImage" src="{{ (!empty($userData->photo)) ? url('upload/user_images/'.$userData->photo) : url('upload/no_image.jpg') }}" 
                                            alt="Admin"  style="width: 100px; height: 100px;">
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-fill-out submit font-weight-bold" name="submit" value="Submit">Változások Mentése</button>
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