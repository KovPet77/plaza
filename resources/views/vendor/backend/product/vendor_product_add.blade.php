@extends('vendor.vendor_dashboard')
@section('vendor')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">

<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">eCommerce</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Új termék hozzáadása</li>
            </ol>
        </nav>
    </div>
 
</div>  
<!--end breadcrumb-->

<div class="card">
  <div class="card-body p-4">
      <h5 class="card-title">Új termék hozzáadása</h5>
      <hr/>

      <form method="POST" action="{{route('vendor.store.product')}}" enctype="multipart/form-data" id="myform">
		 	@csrf
       <div class="form-body mt-4">
        <div class="row">
           <div class="col-lg-8">
           <div class="border border-3 p-4 rounded">

            <div class="mb-3">
                <label for="inputProductTitle" class="form-label">Termék neve</label>
                <input type="text" name="product_name" class="form-control" id="inputProductTitle" placeholder="Enter product title" required>
            </div>

            <div class="mb-3">
                <label for="inputProductTitle" class="form-label">Termék cimkék</label>
                <input type="text" name="product_tags" class="form-control visually-hidden" data-role="tagsinput" value="új termék">
            </div>
            <div class="mb-3">
                <label for="inputProductTitle" class="form-label">Termék méret</label>
                <input type="text" name="product_size" class="form-control visually-hidden" data-role="tagsinput" value="kicsi,közepes, nagy">
            </div>
            <div class="mb-3">
                <label for="inputProductTitle" class="form-label">Termék szín</label>
                <input type="text" name="product_color" class="form-control visually-hidden" data-role="tagsinput" value="piros, kék, Fekete">
            </div>

              <div class="mb-3">
                <label for="inputProductDescription" class="form-label">Termék rövid leírása</label>
                <textarea class="form-control" name="short_desc" id="inputProductDescription" rows="3" required></textarea>
              </div>
              <div class="mb-3">
                <label for="inputProductDescription" class="form-label">Termék hoszzabb leírása</label>
                <textarea id="mytextarea" name="long_desc" required>Hello, World!</textarea>
              </div>

              <div class="mb-3">
                <label for="inputProductTitle" class="form-label">Thumbnail fotó</label>
                <input name="product_thumbnail" class="form-control" type="file" id="formFile" onChange="mainThumbUrl(this)" required>


                <img src="" id="mainThumb" />
              </div> 



              <div class="mb-3">
                <label for="inputProductDescription" class="form-label">Termék fotói</label>
                <input class="form-control" name="multi_img[]" type="file" id="multiImg" multiple required>

                <div class="row"  id="preview_img"></div>
              </div>
            </div>
           </div>
           <div class="col-lg-4">
            <div class="border border-3 p-4 rounded">
              <div class="row g-3">
                <div class="col-md-6">
                    <label for="inputPrice" class="form-label">Termék ára</label>
                    <input type="text" name="selling_price" class="form-control" id="inputPrice" placeholder="00.00" required>
                  </div>
                  <div class="col-md-6">
                    <label for="inputCompareatprice" class="form-label">Diszkont ár</label>
                    <input type="text" name="discount_price" class="form-control" id="inputCompareatprice" placeholder="00.00">
                  </div>
                  <div class="col-md-6">
                    <label for="inputCostPerPrice" class="form-label">Termék kód</label>
                    <input type="text" name="product_code" class="form-control" id="inputCostPerPrice" placeholder="00.00" required>
                  </div>
                  <div class="col-md-6">
                    <label for="inputStarPoints" class="form-label">Termék darabszám</label>
                    <input type="text" name="product_qty" class="form-control" id="inputStarPoints" placeholder="00.00" required>
                  </div>
                  <div class="col-12">
                    <label for="inputProductType" class="form-label">Termék márka</label>

                    <select name="brand_id" class="form-select" id="inputProductType" >
                        <option></option>
                        @foreach($brands as $brand)
                        <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                        @endforeach
                      </select>
                    </div>
                    
                    <div class="col-12">
                      <label for="inputVendor" class="form-label">Termék kategóra</label>
                      <select  name="category_id" class="form-select" id="inputVendor" required>
                        <option></option>
                        @foreach($categories as $cat)
                        <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                        @endforeach
                        
                      </select>
                  </div>

                  <div class="col-12">
                    <label for="inputCollection" class="form-label">Termék alkategória</label>
                    <select name="subcategory_id" class="form-select" id="inputCollection" required>
                        <option></option>
                    
                      </select>
                  </div>


  


                  <div class="col-12">

                  <div class="row g-3">
                  <div class="col-md-6">
                  <div class="form-check">
									<input class="form-check-input" name="hot_deals" type="checkbox" value="1" id="flexCheckDefault">
									<label class="form-check-label" for="flexCheckDefault">Rendkívüli ajánlat</label>
								</div>
                  </div>

                  <div class="col-md-6">
                  <div class="form-check">
									<input class="form-check-input" name="featured" type="checkbox" value="1" id="flexCheckDefault">
									<label class="form-check-label" for="flexCheckDefault">Kiemelt</label>
								</div>
                  </div>

               
                  <div class="col-md-6">
                  <div class="form-check">
									<input class="form-check-input" name="special_offers" type="checkbox" value="1" id="flexCheckDefault">
									<label class="form-check-label" for="flexCheckDefault">Speciális ajánlat</label>
								</div>
                  </div>


                  <div class="col-md-6">
                  <div class="form-check">
									<input class="form-check-input" name="special_deals" type="checkbox" value="1" id="flexCheckDefault">
									<label class="form-check-label" for="flexCheckDefault">Speciális vétel</label>
								</div>
                  </div>
                  </div>
                  </div>

                  <hr>
                  <div class="col-12">
                      <div class="d-grid">
                         <input type="submit" class="btn btn-primary" value="Mentés" />
                      </div>
                  </div>
              </div> 
          </div>
          </div>
       </div><!--end row-->
    </div>
</form>
  </div>
</div>

</div>
<script>
  function mainThumbUrl(input){
    if(input.files && input.files[0]){

      var reader = new FileReader();
      reader.onload = function(e){
        $('#mainThumb').attr('src', e.target.result).width(80).height(80);
      };

      reader.readAsDataURL(input.files[0]);

    }
  }
</script>



<script> 
 
  $(document).ready(function(){
   $('#multiImg').on('change', function(){ //on file input change
      if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
      {
          var data = $(this)[0].files; //this file data
           
          $.each(data, function(index, file){ //loop though each file
              if(/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file.type)){ //check supported file type
                  var fRead = new FileReader(); //new filereader
                  fRead.onload = (function(file){ //trigger function on successful read
                  return function(e) {
                      var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(100)
                  .height(80); //create image element 
                      $('#preview_img').append(img); //append image to output element
                  };
                  })(file);
                  fRead.readAsDataURL(file); //URL representing the file's data.
              }
          });
           
      }else{
          alert("Your browser doesn't support File API!"); //if File API is absent
      }
   });
  });
   
  </script>

  <script>

    $(document).ready(function(){

      $('select[name="category_id"]').on('change', function(){
        var category_id = $(this).val();

        if(category_id){

          $.ajax({
            url: "{{ url('/vendor/subcategory/ajax') }}/"+category_id,
            type: "GET",
            dataType: "json",
            success: function(data){
              $('select[name="subcategory_id"]').html('');
              var d = $('select[name="subcategory_id"]').empty();

              $.each(data, function(key, value){
                $('select[name="subcategory_id"]').append('<option value="'+ value.id +'" >' + value.subcategory_name + '</option>');
              });
            },
          });
        } else{
          alert('danger');
        }
      });
    });
  </script>
@endsection