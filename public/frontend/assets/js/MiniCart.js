// Ez a felugró ablakos kosárba dobás

function addToCart(){

var product_name = $("#pname").text();
var id           = $("#product_id").val();
var vendor_id    = $("#pvendor_id").text();
var color        = $("#color option:selected").text();
var size         = $("#size option:selected").text();
var quantity     = $("#qty").val();

$.ajax({

type: "POST",
dataType: 'json',
data: {

color: color,
size: size,
quantity: quantity,
product_name: product_name,
vendor_id: vendor_id
},

url: '/cart/data/store/'+id,

success: function(data){

miniCart();
miniCartMobil();

$("#closeModal").click(); // Bezárja a felugró ablakot, kosárba dobás után
//console.log(data);

const Toast = Swal.mixin({

  toast: true,  
  position: 'top-end',
  icon: 'success',                          
  showConfirmButton: false,
  timer: 3000
})
if ($.isEmptyObject(data.error)) {

Toast.fire({
  type: 'success',
  title: data.success   
 
})

}else{

  Toast.fire({
  type: 'error',
  title: data.error   
 
})
}
}
})
}




// Ez a termék részletes adatai oldalon lévő kosárba rakás:
function addToCartDetails(){

// Kliens oldali validásció, ha vannak selectek viszont nincsenek kiválasztva, akkor exit. 
    /*
var sizeSelect = document.getElementById('dsize');
var colorSelect = document.getElementById('dcolor');
var addToCartButton = document.getElementById('addToCartButton');

if (sizeSelect.selectedIndex === 0 || colorSelect.selectedIndex === 0) {
event.preventDefault(); // Megakadályozza a küldést
alert('Válassz méretet és színt!');
exit;
}

////////////////////////////////////////////////////
*/

var product_name = $("#dpname").text();
var id = $("#dproduct_id").val();
var vendor = $("#vproduct_id").val();
var color = $("#dcolor option:selected").text();
var size = $("#dsize option:selected").text();
var quantity = $("#dqty").val();
//$('#pvendor_id').text(data.product.vendor_id);

$.ajax({

type: "POST",
dataType: 'json',
data: {

color: color,
size: size,
quantity: quantity,
product_name: product_name,
vendor:vendor
},

url: '/dcart/data/store/'+id,

success: function(data){

miniCart();
miniCartMobil()


const Toast = Swal.mixin({

      toast: true,  
      position: 'top-end',
      icon: 'success',                          
      showConfirmButton: false,
      timer: 3000
})
if ($.isEmptyObject(data.error)) {

    Toast.fire({
      type: 'success',
      title: data.success   
     
  })

}else{

      Toast.fire({
      type: 'error',
      title: data.error   
     
  })
}
}
})

}


/*
// Ez a termék részletes adatai oldalon lévő kosárba rakás, ha nem póló és nincs mérete a terméknek:
 function addToCartDetailsWithoutSizes(){

var product_name = $("#dpname").text();
var id = $("#dproduct_id").val();
var vendor = $("#vproduct_id").val();
var color = $("#dcolor option:selected").text();
var size = $("#dsize option:selected").text();
var quantity = $("#dqty").val();
//$('#pvendor_id').text(data.product.vendor_id);

$.ajax({

 type: "POST",
 dataType: 'json',
 data: {

     color: color,
     size: size,
     quantity: quantity,
     product_name: product_name,
     vendor:vendor
 },

 url: '/dcart/data/store/'+id,

 success: function(data){

     miniCart();
     miniCartMobil();
     const Toast = Swal.mixin({

           toast: true,  
           position: 'top-end',
           icon: 'success',                          
           showConfirmButton: false,
           timer: 3000
     })
     if ($.isEmptyObject(data.error)) {

         Toast.fire({
           type: 'success',
           title: data.success   
          
       })

     }else{

           Toast.fire({
           type: 'error',
           title: data.error   
          
       })
     }
 }
})
}
  
     */   
function miniCart(){
$.ajax({
type: 'GET',
url: '/product/mini/cart',
dataType: 'json',

success: function(response){
//console.log('ez fut le most', response)


$('span[id="cartSubTotal"]').text(response.cartTotal);
$("#cartQty").text(response.cartQty);

var miniCart = "";

$.each(response.carts, function(key, value){

    miniCart += `<ul>
    <li>
        <div class="shopping-cart-img">
            <a href=""><img alt="Nest" src="/${value.options.image}" style="width:50px; height:50px;" /></a>
        </div>
        <div class="shopping-cart-title" style="margin: -73px 74px 14px;">
            <h4><a href="">${value.name}</a></h4>
            <h4><span>${value.qty} x </span>${value.price}</h4>
        </div>
        <div class="shopping-cart-delete" style="margin: -85px 1px 0px;">
            <a type="submit" id="${value.rowId}" onclick="miniCartRemove(this.id)"><i class="fi-rs-cross-small"></i></a>
        </div>
    </li>

</ul>
<hr>
<br>
`
});

$("#miniCart").html(miniCart);

}
})


}





    function miniCartMobil(){
        $.ajax({
        type: 'GET',
        url: '/product/mini/cart',
        dataType: 'json',

        success: function(response){
        //console.log(response)


        $('span[id="cartSubTotalMobil"]').text(response.cartTotal);
        $("#cartQtyMobil").text(response.cartQty);

        var miniCartMobil = "";

$.each(response.carts, function(key, value){

    miniCartMobil += `<ul>
    <li>
        <div class="shopping-cart-img">
            <a href="shop-product-right.html"><img alt="Nest" src="/${value.options.image}" style="width:50px; height:50px;" /></a>
        </div>
        <div class="shopping-cart-title" style="margin: -73px 74px 14px;">
            <h4><a href="">${value.name}</a></h4>
            <h4><span>${value.qty} x </span>${value.price}</h4>
        </div>
        <div class="shopping-cart-delete" style="margin: -85px 1px 0px;">
            <a type="submit" id="${value.rowId}" onclick="miniCartRemove(this.id)"><i class="fi-rs-cross-small"></i></a>
        </div>
    </li>
</ul>
<hr>
<br>
`
});

$("#miniCartMobil").html(miniCartMobil);

}
})
}
miniCartMobil();



// Kis kosár törlés

function miniCartRemove(rowId){

        $.ajax({

        type: 'GET',
        url: '/minicart/product/remove/'+rowId,
        dataType: 'json',

        success: function(data){
              miniCartMobil();  
              miniCart(); 
               Cart(); 
              const Toast = Swal.mixin({

              toast: true,  
              position: 'top-end',
              icon: 'success',                          
              showConfirmButton: false,
              timer: 3000
        })
        if ($.isEmptyObject(data.error)) {

            Toast.fire({
              type: 'success',
              title: data.success   
             
          })

        }else{

              Toast.fire({
              type: 'error',
              title: data.error   
             
          })
        }
        }

        });
              cartRemove();
                couponCalculation();

}



function miniCartRemoveMobil(rowId){

        $.ajax({

        type: 'GET',
        url: '/minicart/product/remove/'+rowId,
        dataType: 'json',

        success: function(data){

              miniCartRemoveMobil();  
              const Toast = Swal.mixin({

              toast: true,  
              position: 'top-end',
              icon: 'success',                          
              showConfirmButton: false,
              timer: 3000
        })
        if ($.isEmptyObject(data.error)) {

            Toast.fire({
              type: 'success',
              title: data.success   
             
          })

        }else{

              Toast.fire({
              type: 'error',
              title: data.error   
             
          })
        }
        }

        });

}
