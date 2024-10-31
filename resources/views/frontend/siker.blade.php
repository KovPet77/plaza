
@extends('frontend.master_dashboard')
@section('main')
     <div class="container mb-80 mt-50">
 <div class="row">
   <div class="col-lg-6">
<h1 style="color: #b02828;">Sikeres rendelés leadás!</h1>
A rendelés adatait elküldtük email-ben!
Amint a rendelés feldolgozása teljesül értesítjük!
Köszönjük!
</div>
</div>
</div>

<script type="text/javascript">
  // Felugró ablak megjelenítése
var confirmation = confirm(" Köszönjük a Rendelést! Az oldal pár másodperc múlva átirányít a kezdőlapra");

// Ha a felhasználó elfogadja a felugró ablakot
if (confirmation) {
    // Várunk 3 másodpercet, majd átirányítjuk a böngészőt a '/' útvonalra
    setTimeout(function() {
        window.location.href = "/";
    }, 3000); // 3000 ms = 3 másodperc
}
</script>
@endsection