@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">

<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Admin</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Hirdetés hozzáadása</li>
            </ol>
        </nav>
    </div>
 
</div>  
<!--end breadcrumb-->

<div class="card">
  <div class="card-body p-4">
      <h5 class="card-title">Hirdetés hozzáadása</h5>
      <hr/>

      <form method="POST" action="{{route('store.advertiser')}}" enctype="multipart/form-data" id="myform">
		 	@csrf
       <div class="form-body mt-4">
        <div class="row">
           <div class="col-lg-8">
           <div class="border border-3 p-4 rounded">

            <div class="mb-3">
                <label for="inputProductTitle" class="form-label">Hirdető neve</label>
                <input type="text" name="name" class="form-control" id="inputProductTitle" placeholder="Hirdető neve" required>
            </div>
        <div class="mb-3">
                <label for="inputProductTitle" class="form-label">Hirdető email címe</label>
                <input type="email" name="email" class="form-control" id="inputProductTitle" placeholder="Hirdető email címe" required>
            </div>
            <div class="mb-3">
                <label for="inputProductTitle" class="form-label">Hirdető telefonszáma</label>
                <input type="text" name="phone" class="form-control" id="inputProductTitle" placeholder="Hirdető telefonszáma" required>
            </div>

        
              <div class="mb-3">
                <label for="inputProductDescription" class="form-label">Hirdetési szöveg</label>
                <textarea id="mytextarea" name="leiras" required>Hello, World!</textarea>
              </div>
            <!--
              <div class="mb-3">
                <label for="inputProductTitle" class="form-label">Thumbnail fotó</label>
                <input name="product_thumbnail" class="form-control" type="file" id="formFile" onChange="mainThumbUrl(this)" required>


                <img src="" id="mainThumb" />
              </div> 
             -->


              <div class="mb-3">
                <label for="inputProductDescription" class="form-label">Termék fotói</label>
                <input class="form-control" name="foto" type="file" id="multiImg" multiple required>

                <div class="row"  id="preview_img"></div>
              </div>
            </div>
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
/*
$(document).ready(function(){
    $('select[name="category_id"]').on('change', function(){
        var category_id = $(this).val();

        if(category_id){
            $.ajax({
                url: "{{ url('/subcategory/ajax') }}/"+category_id,
                type: "GET",
                dataType: "json",
                success: function(data){
                    $('select[name="subcategory_id"]').html('');
                    var selectElement = $('select[name="subcategory_id"]');
                    var subcategorySlugInput = $('input[name="subcategory_slug"]');
                    console.log(data);

                    $.each(data, function(key, value){
                        selectElement.append('<option value="'+ value.id +'" data-slug="' + value.subcategory_slug + '">' + value.subcategory_name + '</option>');
                    });

                    // Beállítjuk az első option értékét a rejtett input mezőbe
                    var firstOption = selectElement.find('option:first');
                    var slug = firstOption.data('slug');
                    subcategorySlugInput.val(slug);

                    // Eseménykezelő a kiválasztott alkategória változására
                    selectElement.on('change', function(){
                        var selectedOption = $(this).find('option:selected');
                        var slug = selectedOption.data('slug'); // Az alkategória subcategory_slug értéke
                        subcategorySlugInput.val(slug); // Beállítjuk a rejtett input értékét
                    });
                },
            });
        } else {
            alert('danger');
        }
    });
});

*/

  </script>
@endsection