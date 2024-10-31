

<!DOCTYPE html>
<html class="no-js" lang="en">
@php

 $seo = App\Models\SEO::find(1);
@endphp

<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />



    <meta name="title" content="{{ $seo->meta_title }}" />
    <meta name="author" content="{{ $seo->meta_author }}" />
    <meta name="keywords" content="{{ $seo->meta_keyword }}" />
    <meta name="description" content="{{ $seo->meta_description }}" />


    <meta  name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="Pomáz Pláza" />
    <meta property="og:description" content="Sok minden egy helyen" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://pomazplaza.hu" />
    <meta property="og:image" content="https://pomazplaza.hu/public/upload/Logo.png" />


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" type="text/css" media="all" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.6.0/nouislider.min.css">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/assets/imgs/theme/favicon.png') }}" />
  
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/plugins/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css?v=5.3') }}" />
    <script src="{{asset('frontend/assets/js/plugins/wow.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
   
    <script src="https://js.stripe.com/v3/"></script>
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.6.0/nouislider.min.js"></script>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
/* Reset iPhone gomb  */
/*
input[type="button"],
input[type="a"],
input[type="submit"],
input[type="reset"] {
    -webkit-appearance: none; /* Reset iPhone gomb stílusát */
}
*/

#searchProducts{
    position: absolute;
    top: 100%;
    left: 0;
    width: 100%;
    background-color: #ffffff;
    z-index: 998;
    border-radius: 8px;
    margin-top: 5px;
}

.inputcolor{
    border: 1px solid #5e5e5e !important;
}


.vertical-menu {
    width: 200px;
}

.vertical-menu a {
    padding: 10px;
    text-decoration: none;
    color: #333;
    display: block;
}

.vertical-menu a:hover {
    background-color: #f2f2f2;
}

.vertical-menu .submenu {
    display: none;
    list-style-type: none;
    padding-left: 20px;
}

.vertical-menu .submenu li {
    padding: 5px 0;
}

.vertical-menu .submenu a {
    text-decoration: none;
    color: #555;
}
.filter-form {
    display: flex; /* Egy sorban helyezi el az űrlapokat */
    align-items: center; /* Középre igazítja az űrlapokat a magasságuk mentén */
}

.search-bar {
    flex-grow: 1; /* Az input mező foglalja el a rendelkezésre álló helyet */
    display: flex; /* Egy sorban helyezi el az input mezőt és a gombot */
}

input[type="text"] {
    flex-grow: 1; /* Az input mező foglalja el a rendelkezésre álló helyet */
    margin-right: 10px; /* Térköz a keresőmező és a gomb között */
}







/* Mobil nézet */
@media (max-width: 767px) {
    .filter-form {
        display: block; /* Mobil nézetben egymás alá helyezzük az űrlapokat */
    }

    .search-bar,
    .sort-by-product-area {
        margin-bottom: 10px; /* Opcionálisan hagyhatunk egy kis térközt az űrlapok között mobil nézetben */
    }
}

/* Asztali és széles képernyő */
@media (min-width: 768px) {
    .filter-form {
        display: flex; /* Asztali és széles képernyőn egymás mellé helyezzük az űrlapokat */
        align-items: center; /* Középre igazítjuk az űrlapokat a magasságuk mentén */
    }

    .search-bar {
        margin-right: 10px; /* Térköz az űrlapok között */
    }
}

    </style>
</head>

<body>
 
        @include('frontend.body.quickview')
        @include('frontend.body.header')       
        

        <main class="main">
            @yield('main')
        </main>
        
        
        @include('frontend.body.footer')
  

    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="text-center">
                    <!-- <img src="{{asset('frontend/assets/imgs/theme/loading.gif')}}" alt="" /> -->
                </div>
            </div>
        </div>
    </div>
   
    <script src="{{asset('frontend/assets/js/vendor/modernizr-3.6.0.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/vendor/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/vendor/jquery-migrate-3.3.0.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/vendor/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/slick.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/jquery.syotimer.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/waypoints.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/wow.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/magnific-popup.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/select2.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/counterup.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/jquery.countdown.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/images-loaded.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/isotope.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/scrollup.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/jquery.vticker-min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/jquery.theia.sticky.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/jquery.elevatezoom.js')}}"></script>
  
    <script src="{{asset('frontend/assets/js/main.js?v=5.3')}}"></script>
    <script src="{{asset('frontend/assets/js/shop.js?v=5.3')}}"></script>
    <script src="{{asset('frontend/assets/js/MiniCart.js')}}"></script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>






<script>
$(document).ready(function () {
    $('.vertical-menu .submenu').hide(); // Kezdetben minden almenü el van rejtve

    $('.vertical-menu .parent-menu').click(function () {
        // Elrejtjük az összes másik almenüt
        $('.vertical-menu .submenu').not($(this).next('.submenu')).slideUp();
        
        // Megjelenítjük vagy elrejtjük az aktuális szülőmenü alatti almenüt
        $(this).next('.submenu').slideToggle();
        
        // Megakadályozzuk a link alapértelmezett működését
        return false;
    });
});

</script>



<script>
document.addEventListener("DOMContentLoaded", function () {
    const sliderRange = document.getElementById("slider-range");
    const priceRangeInput = document.getElementById("price_range");
    const manualMinimumInput = document.getElementById("manualminimum");
    const manualMaximumInput = document.getElementById("manualmaximum");

    if (sliderRange) {
        const maxPrice = parseInt(sliderRange.getAttribute("data-max"));
        const minPrice = parseInt(sliderRange.getAttribute("data-min"));

        // Módosított léptékek 500-asával
        const step = 500;
        const range = {
            min: minPrice,
            max: maxPrice,
        };

        let priceRange = [minPrice, maxPrice];

        noUiSlider.create(sliderRange, {
            start: priceRange,
            connect: true,
            range: range,
            step: step, // Hozzáadva a lépték
            format: {
                to: function (value) {
                    return parseInt(value);
                },
                from: function (value) {
                    return parseInt(value);
                },
            },
        });

        sliderRange.noUiSlider.on("update", function (values, handle) {
            const formattedValue = values.join("-");
            priceRangeInput.value = formattedValue;
            
            if (handle === 0) {
                manualMinimumInput.value = 'teszt';
            } else if (handle === 1) {
                manualMaximumInput.value = values[1];
            }
        });
    }
});





</script>





    <script type="text/javascript">
        

    $(document).ready(function() {
        // Ajax keresés
    const site_url = "/";

    $("body").on("keyup", "#search", function() {
        let text = $(this).val();
        //console.log(text);

        if (text.length > 0) {
            $.ajax({

                data: { search: text },
                url: site_url + "search-product",
                method: 'post',        

                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(result) {
                    $("#searchProducts").html(result);
                }
            });
        }   

        if (text.length < 1) {
            $("#searchProducts").html("");
        }
    });
});
    </script>



    <script type="text/javascript">
        

$(document).ready(function() {
    const site_url = "/";

    $("body").on("keyup", "#searchVendorInput", function() {   
        let text = $(this).val();

        if (text.length > 0) {
            $.ajax({
                data: { search: text },
                url: site_url + "search-vendor",
                method: 'post',        
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(result) {
                    $("#searchVendorResults").html(result); // Módosítás: eredményt az id="searchVendorResults" elembe szúrjuk be
                }
            });
        }   
        if (text.length < 1) {
            $("#searchVendorResults").html(""); // Módosítás: üresítjük a keresési eredményeket
        }
    });
});

    </script>


    <script type="text/javascript">
        

    $(document).ready(function() {
        // Ajax keresés
    const site_url = "https://pomazplaza/";

    $("body").on("keyup", "#search", function() {
        let text = $(this).val();
        //console.log(text);

        if (text.length > 0) {
            $.ajax({

                data: { search: text },
                url: site_url + "search-product",
                method: 'post',        

                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(result) {
                    $("#searchProductsMobil").html(result);
                }
            });
        }   

        if (text.length < 1) {
            $("#searchProductsMobil").html("");
        }
    });
});
    </script>









    <script>
        
$.ajaxSetup({

    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})

// Termék megjelenítő felugró modal adattal való kitöltése:
function productView(id){

$.ajax({

    type: 'GET',
    url: '/product/view/modal/'+id,  
    dataType: 'json',

    success: function(data){
        

//console.log(data.color);
//console.log(data.size);

const formattedSellingPrice = parseFloat(data.product.selling_price).toLocaleString('hu-HU', {
    style: 'currency',
    currency: 'HUF',
      minimumFractionDigits: 0
});    

const formattedDiscountPrice = parseFloat(data.product.discount_price).toLocaleString('hu-HU', {
    style: 'currency',
    currency: 'HUF',
    minimumFractionDigits: 0
}); 



$('#pname').text(data.product.product_name);
$('#vendor_id').text(data.product.vendor_id);
$('#pprice').text(data.product.selling_price);
$('#pcode').text(data.product.product_code);
$('#pcategory').text(data.product.category.category_name);
// Ez nem biztos, hogy létezik mindegyiknél,ezért hibát dobhat: 
//$('#pbrand').text(data.product.brand.brand_name);
$('#pimage').attr('src', '/'+data.product.product_thumbnail);

$('#pvendor_id').text(data.product.vendor_id);

$("#product_id").val(id);
$("#qty").val(1); // Darabszám minimum értéke: 1


// Termék ár

if (data.product.discount_price == null) {

$('#pprice').text('');
$('#oldprice').text('');
$('#pprice').text(formattedSellingPrice);

}else{

$('#pprice').text(formattedDiscountPrice);
$('#oldprice').text(formattedSellingPrice);


}


if (data.product.product_qty > 0) {

$('#available').text('');
$('#stockout').text('');
$('#available').text('Raktáron');
}
else{
$('#available').text('');
$('#stockout').text('');
$('#stockout').text('Nem elérhető');
}

console.log('emptyAttributes:',data.emptyAttributes);

 // Méret:
$('select[name="size"]').empty();
$('select[name="size"]').append('<option value="">Válassz méretet...</option>'); // Üres mező hozzáadása
$.each(data.size, function(key, value) {
    $('select[name="size"]').append('<option value="' + value + '">' + value + '</option>');
});



if (data.emptyAttributes === 'nincs') {
    $("#sizeArea").hide();
} else {
    $("#sizeArea").show();
}

// Szín
$('select[name="color"]').empty();
$('select[name="color"]').append('<option value="">Válassz színt...</option>'); // Üres mező hozzáadása
$.each(data.color, function(key, value) {
    $('select[name="color"]').append('<option value="' + value + '">' + value + '</option>');
});

if (data.emptyAttributes === 'nincs') {
    $("#colorArea").hide();
} else {
    $("#colorArea").show();
}



}
});
}


</script>


    <script>
        
function addToWishList(product_id){

$.ajax({

type: 'POST',
dataType: 'json',
url: '/addtowishlist/'+product_id,

success:function(data){

 // Success esetén a wishlist funkció hívása, hogy frissüljön a kívánságlista számjelző      
wishlist()

const Toast = Swal.mixin({

          toast: true,  
          position: 'top-end',
                                
          showConfirmButton: false,
          timer: 3000
    })
    if ($.isEmptyObject(data.error)) {

        Toast.fire({
          type: 'success',
          icon: 'success', 
          title: data.success   
         
      })

    }else{

          Toast.fire({
          type: 'error',
          icon: 'error', 
          title: data.error   
         
      })
    }
}
});

}

    </script>

<script>
        
function wishlist(){

$.ajax({

type: 'GET',
dataType: 'json',
url: '/get-wishlist-product/',

success:function(response){


    $("#wishQty").text(response.wishQty);
    var rows = "";

    $.each(response.wishlist, function(key, value){

        rows += `

      <tr class="pt-30">
            <td class="custome-checkbox pl-30">
           
            </td>
            <td class="image product-thumbnail pt-40"><img src="/${value.product.product_thumbnail}" alt="#" /></td>
               <td class="product-des product-name">
                <h6><a class="product-name mb-10" href="shop-product-right.html">${value.product.product_name}</a></h6>
                <div class="product-rate-cover">
                    <div class="product-rate d-inline-block">
                        <div class="product-rating" style="width: 90%"></div>
                    </div>
                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                </div>
            </td>
            <td class="price" data-title="Price">

            ${value.product.discount_price == null 
            
               
            ? `<h3 class="text-brand">${value.product.selling_price}</h3>`

            : `<h3 class="text-brand">${value.product.discount_price}</h3>`

             }


            </td>
            <td class="text-center detail-info" data-title="Stock">
             ${value.product.product_qty > 0

                
             ? `<span class="stock-status in-stock mb-0">Raktáron</span>`

               
             :  `<span class="stock-status out-stock mb-0">Nincs raktáron</span>`
         } 
            </td>
    
            <td class="action text-center" data-title="Törlöm">
                <a type="submit"  class="text-body" id="${value.id}" onclick="wishlistRemove(this.id)"><i class="fi-rs-trash" ></i></a>
            </td>
        </tr>
        `
    });


    $("#wishlist").html(rows);
}
});

}

wishlist();



// Kívánságlista termék törlés:
function wishlistRemove(id){

$.ajax({

type: 'GET',
dataType: 'json',
url: '/remove-wishlist/'+id,

success:function(data){

// Success esetén a wishlist funkció hívása, hogy le is frissüljön a lista    
wishlist();

const Toast = Swal.mixin({

          toast: true,  
          position: 'top-end',
                                
          showConfirmButton: false,
          timer: 3000
    })
    if ($.isEmptyObject(data.error)) {

        Toast.fire({
          type: 'success',
          icon: 'success', 
          title: data.success   
         
      })

    }else{

          Toast.fire({
          type: 'error',
          icon: 'error', 
          title: data.error   
         
      })
    }
}
});

}


    </script>





        <script>
        
function addToCompare(product_id){

$.ajax({

type: "POST",
url: "/add-to-compare/"+product_id,
dataType: 'json',

success:function(data){


const Toast = Swal.mixin({

      toast: true,  
      position: 'top-end',
                            
      showConfirmButton: false,
      timer: 3000
})
if ($.isEmptyObject(data.error)) {

    Toast.fire({
      type: 'success',
      icon: 'success', 
      title: data.success   
     
  })

}else{

      Toast.fire({
      type: 'error',
      icon: 'error', 
      title: data.error   
     
  })
}
}
});

}
    </script>
    <script>
        
        function compare(){

            $.ajax({

                type: 'GET',
                dataType: 'json',
                url: '/get-compare-product/',

                success:function(response){
         
                  
                    var rows = "";

                    $.each(response, function(key, value){

            rows += `       <tr class="pr_image">
                        <td class="text-muted font-sm fw-600 font-heading mw-200">Preview</td>
                        <td class="row_img"><img src="/${value.product.product_thumbnail}" style="width:300px; height:300px;" alt="compare-img" /></td>
                              
                                </tr>
                                <tr class="pr_title">
                                    <td class="text-muted font-sm fw-600 font-heading">Name</td>
                                    <td class="product_name">
                                        <h6><a href="shop-product-full.html" class="text-heading">${value.product.product_name}</a></h6>
                                    </td>
                                    
                                </tr>
                                <tr class="pr_price">
                                    <td class="text-muted font-sm fw-600 font-heading">Price</td>
                                    <td class="product_price">

                            ${value.product.discount_price == null 
                            
                               
                            ? ` <h4 class="price text-brand">${value.product.selling_price}</h4>`

                            : ` <h4 class="price text-brand">${value.product.discount_price}</h4>`

                             }
                                        
                                    </td>
                                </tr>            


                                <tr class="description">
                                    <td class="text-muted font-sm fw-600 font-heading">Description</td>
                                    <td class="row_text font-xs">
                                        <p class="font-sm text-muted">${value.product.short_desc}</p>
                                    </td>                      
                                </tr>
                                <tr class="pr_stock">

                               <td class="text-muted font-sm fw-600 font-heading">

                               ${value.product.product_qty > 0

                                
                             ? `<span class="stock-status in-stock mb-0">Raktáron</span>`

                               
                             :  `<span class="stock-status out-stock mb-0">Nincs raktáron</span>`
                              } 
                                    </td>                 
                                </tr>
                      
                    <tr class="pr_remove text-muted">
                        <td class="text-muted font-md fw-600"></td>
                        <td class="row_remove">
                            <a type="submit" id="${value.id}" onclick="compareRemove(this.id)" class="text-muted"><i class="fi-rs-trash mr-5"></i><span>Remove</span> </a>
                        </td>
                        
                    </tr> `
                    });


                    $("#compare").html(rows);
                }
            });

        }

        compare();



        function compareRemove(id){

            $.ajax({

                type: 'GET',
                dataType: 'json',
                url: "/compare-remove/"+id,

                success:function(data){

                // Success esetén a compare funkció hívása, hogy le is frissüljön a lista    
                compare();

                const Toast = Swal.mixin({

                          toast: true,  
                          position: 'top-end',
                                                
                          showConfirmButton: false,
                          timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {

                        Toast.fire({
                          type: 'success',
                          icon: 'success', 
                          title: data.success   
                         
                      })

                    }else{

                          Toast.fire({
                          type: 'error',
                          icon: 'error', 
                          title: data.error   
                         
                      })
                    }
                }
            });

        }

    </script>

    <script>

        // Kosár oldal
          function Cart(){
        $.ajax({
        type: 'GET',
        url: '/get-cart-product/',
        dataType: 'json',

        success: function(response){        

          var rows = "";

        $.each(response.carts, function(key, value){

        const formattedPrice = parseFloat(value.price).toLocaleString('hu-HU', {
            style: 'currency',
            currency: 'HUF',
            minimumFractionDigits: 0
        });       

         const formattedSubtotal = parseFloat(value.subtotal).toLocaleString('hu-HU', {
            style: 'currency',
            currency: 'HUF',
            minimumFractionDigits: 0
        });
        rows += `
        <tr class="pt-30">
        <td class="custome-checkbox pl-30">
             
        </td>
        <td class="image product-thumbnail pt-40"><img src="${value.options.image}" alt="#"></td>
        <td class="product-des product-name">
            <h6 class="mb-5"><a class="product-name mb-10 text-heading" href="">${value.name}</a></h6>
        
        </td>
        <td class="price" data-title="Ár">
            <h4 class="text-body">${formattedPrice}</h4>
        </td>


                <td class="price" data-title="Méret">

                ${value.options.color == null 

                ? `<span>...</span>`

                : ` <h6 class="text-body">${value.options.color}</h6>`

            }
                   
                </td>
               <td class="price" data-title="Szín">

                ${value.options.size == null 

                ? `<span>...</span>`

                : ` <h6 class="text-body">${value.options.size}</h6>`

            }
                   
                </td>

                <td class="text-center detail-info" data-title="Darabszám">
                    <div class="detail-extralink mr-15">
                        <div class="detail-qty border radius" style="padding: 20px !important;">


      <a  class="qty-down" type="submit"  id="${value.rowId}" onclick="cartDecrement(this.id)"><i class="fi-rs-angle-small-down"></i></a>

        <input type="text" name="quantity" class="qty-val" value="${value.qty}" min="1">

        <a  class="qty-up"  type="submit"  id="${value.rowId}" onclick="cartIncrement(this.id)"><i class="fi-rs-angle-small-up"></i></a>
                        </div>
                    </div>
                </td>
                <td class="price" data-title="Ár">
                    <h4 class="text-brand">${formattedSubtotal}</h4>
                </td>

                <td class="action text-center" data-title="Törlés">

                <a class="text-body" type="submit"  id="${value.rowId}" onclick="cartRemove(this.id)"><i class="fi-rs-trash"></i></a>
                </td>
            </tr>

                    `
                    });

                    $("#CartPage").html(rows);

                }
            })
        

        }
            Cart();

        // Kosár oldal törlés:
         function cartRemove(id){

            $.ajax({

                type: 'GET',
                dataType: 'json',
                url: "/cart-remove/"+id,

                success:function(data){

                // Success esetén a Cart és a miniCart funkció hívása, hogy le is frissüljön a lista 
                couponCalculation();
                Cart();
                miniCart();
                miniCartMobil();

                const Toast = Swal.mixin({

                          toast: true,  
                          position: 'top-end',
                                                
                          showConfirmButton: false,
                          timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {

                        Toast.fire({
                          type: 'success',
                          icon: 'success', 
                          title: data.success   
                         
                      })

                    }else{

                          Toast.fire({
                          type: 'error',
                          icon: 'error', 
                          title: data.error   
                         
                      })
                    }
                }
            });

        }



        function cartDecrement(rowId){


            $.ajax({

                type: "GET",
                url: "/cart-decrement/"+rowId,
                dataType: 'json',

                success:function(data){

                    // Darabszám csökkentése után list frissítés:
                    couponCalculation();
                    Cart();
                    miniCart();

                }
            });

        }       





         function cartIncrement(rowId){


            $.ajax({

                type: "GET",
                url: "/cart-increment/"+rowId,
                dataType: 'json',

                success:function(data){

                    // Darabszám csökkentése után list frissítés:
                    couponCalculation();
                    Cart();
                    miniCart();

                }
            });

        }
    </script>

    <script>
        
        function applyCoupon(){

            var coupon_name = $("#coupon_name").val();


            $.ajax({

                type: 'POST',
                dataType: 'json',
                data: {coupon_name: coupon_name},
                url: "/coupon-apply",

                success:function(data){
       
                 couponCalculation();

                if (data.validity == true) {


                    $('#couponField').hide();
                }
                          
                const Toast = Swal.mixin({

                          toast: true,  
                          position: 'top-end',
                                                
                          showConfirmButton: false,
                          timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {

                        Toast.fire({
                          type: 'success',
                          icon: 'success', 
                          title: data.success   
                         
                      })

                    }else{

                          Toast.fire({
                          type: 'error',
                          icon: 'error', 
                          title: data.error   
                         
                      })
                    }
                }
            });
        }


        function couponCalculation(){

            $.ajax({

                type: 'GET',
                url: '/coupon-calculation',
                dataType: 'json',

                success: function(data){

                 const formattedTotal = parseFloat(data.total).toLocaleString('hu-HU', {
                        style: 'currency',
                        currency: 'HUF',
                        minimumFractionDigits: 0
                    });

                    if (data.total) {

                    $("#couponCalField").html(

                       `              
                       <tr>
                        <td class="cart_total_label">
                            <h6 class="text-muted">Részösszeg</h6>
                        </td>
                        <td class="cart_total_amount">
                            <h4 class="text-brand text-end">${formattedTotal}</h4>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="cart_total_label">
                            <h6 class="text-muted">Total</h6>
                        </td>
                        <td class="cart_total_amount">
                            <h4 class="text-brand text-end">${formattedTotal}</h4>
                        </td>
                    </tr>

                     `

                        )


                    }else{

                        $("#couponCalField").html(


                       `              
                       <tr>
                        <td class="cart_total_label">
                            <h6 class="text-muted">Részösszeg</h6>
                        </td>
                        <td class="cart_total_amount">
                            <h4 class="text-brand text-end">${data.subtotal} Ft.</h4>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="cart_total_label">
                            <h6 class="text-muted">Kupon</h6>
                        </td>
                        <td class="cart_total_amount">
                            <h6 class="text-brand text-end">${data.coupon_name} Ft. 
                            <a type="submit" onclick="couponRemove()"><i class="fi-rs-trash"> </i></a></h6>
                        </td>
                    </tr>



                    <tr>
                        <td class="cart_total_label">
                            <h6 class="text-muted">Diszkont</h6>
                        </td>
                        <td class="cart_total_amount">
                            <h4 class="text-brand text-end">${data.discount_amount} Ft.</h4>
                        </td>
                    </tr>



                    <tr>
                        <td class="cart_total_label">
                            <h6 class="text-muted">Fizetendő</h6>
                        </td>
                        <td class="cart_total_amount">
                            <h4 class="text-brand text-end">${data.total_amount} Ft.</h4>
                        </td>
                    </tr>

                     `


                            )
                    }

                }

            });
        }

        couponCalculation();

    </script>

    <script>
        
       function couponRemove(){

            $.ajax({

                type: 'GET',
                dataType: 'json',
                url: "/coupon-remove",

                success:function(data){

                couponCalculation();
                 $("#couponField").show();

                const Toast = Swal.mixin({

                          toast: true,  
                          position: 'top-end',
                                                
                          showConfirmButton: false,
                          timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {

                        Toast.fire({
                          type: 'success',
                          icon: 'success', 
                          title: data.success   
                         
                      })

                    }else{

                          Toast.fire({
                          type: 'error',
                          icon: 'error', 
                          title: data.error   
                         
                      })
                    }
                }
            });

        }
    </script>

    
</body>

</html>