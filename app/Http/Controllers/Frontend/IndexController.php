<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\MultiImg;
use App\Models\Brand;
use App\Models\Product;
use App\Models\User;





class IndexController extends Controller
{
    


    public function Csomagok(){
      return view('frontend.home.csomagok');
    }



    public function Index(){
        
        
        
                    #$ip_address = $_SERVER['REMOTE_ADDR'];
                    #echo "Az IP-cím: " . $ip_address;
                    #46.139.123.59
                    
                    /*
                    if ($ip_address !== '46.139.123.59') {
                         echo "<h1 style='font-size:80px;'>Az oldal fejlesztés alatt...</h1>";
                        die();
                    }
                    */

        $skip_category_0 = Category::skip(0)->first();
        $skip_product_0 = Product::where('status', 1)->where('category_id', $skip_category_0->id)->orderBy('id', 'DESC')->limit(5)->get();


        $skip_category_1 = Category::skip(1)->first();
        $skip_product_1 = Product::where('status', 1)->where('category_id', $skip_category_1->id)->orderBy('id', 'DESC')->limit(5)->get();


        $skip_category_2 = Category::skip(2)->first();
        $skip_product_2 = Product::where('status', 1)->where('category_id', $skip_category_2->id)->orderBy('id', 'DESC')->limit(5)->get();


        $hot_deals = Product::where('hot_deals', 1)->where('discount_price', '!=', NULL)->orderBy('id', 'DESC')->limit(3)->get();
        #dd($hot_deals);


        $special_offers = Product::where('special_offers', 1)->orderBy('id', 'DESC')->limit(3)->get();


        $new_products = Product::where('status', 1 )->orderBy('id', 'DESC')->limit(3)->get();


        $special_deals = Product::where('special_deals', 1)->orderBy('id', 'DESC')->limit(3)->get();




        return view('frontend.index', compact('skip_category_0', 'skip_product_0', 'skip_category_1', 'skip_product_1', 'skip_category_2',
            'skip_product_2', 'hot_deals', 'special_offers', 'new_products', 'special_deals'));
        
    }




    public function ProductDetails($id, $slug){


        $product = Product::findOrFail($id);

        $color = $product->product_color;

        $product_color = explode(',', $color);


        $size = $product->product_size;

        $product_size = explode(',', $size);

        $multImage = MultiImg::where('product_id', $id)->get();

        $cat_id = $product->category_id;

        $relatedProduct = Product::where('category_id', $cat_id)->where('id', '!=', $id)->orderBy('id', 'DESC')->limit(4)->get();

        #dd($product);

        return view('frontend.product.product_details', compact('product', 'product_color', 'product_size', 'multImage', 'relatedProduct'));

    }

/*
    public function VendorDetails($id){

        $perPage = 10;
        $vendor = User::findOrFail($id);    
        $vproduct = Product::where('vendor_id', $id);
        $vproduct = $vproduct->paginate($perPage);
        #dd($vproduct);

        return view('frontend.vendor.vendor_details', compact('vendor', 'vproduct'));

    }
*/

public function VendorDetails($slug){

    $perPage = 10;
    $vendor = User::where('vendor_slug', $slug)->first();
    #dd($vendor);
    // Lekérjük a products táblából a különböző subcategory_slug értékeket, majd csoportosítjuk
    $subcategories = Product::where('vendor_id', $vendor->id)
        ->select('subcategory_slug')
        ->distinct() // Csak a különböző subcategory_slug értékeket kérjük
        ->get();

    // Lekérjük a sub_categories táblából az egyező subcategory_slug értékeket
    $subcategoryImages = SubCategory::whereIn('subcategory_slug', $subcategories->pluck('subcategory_slug'))
        ->select('subcategory_slug', 'subcategory_image', 'subcategory_name')
        ->get();

    session(['vendor_id' => $vendor->id]);



    // Most a $subcategoryImages tartalmazza az egyező subcategory_slug értékeket és azok képeit

    return view('frontend.vendor.vendor_details', compact('vendor', 'subcategoryImages'));
}




    public function getVendorProductsByCategory($subcategorySlug){ 

    // EZ a funkció akkor fut le, amikor az eladóhoz tartozó kategória fotókra kattintok. Tehát ez az az utáni oldal, terméklista.


        $perPage = 10;
        // Az id kinyerése a session-ből
        $vendorId = session('vendor_id');

        #dd('ez a getVendorProductsByCategory funkció');
        // Az eladó termékeinek lekérése a megadott kategória slug alapján
        $vendor = User::findOrFail($vendorId);

        // Az összes termék lekérése, ahol a subcategory_slug egyezik, és paginálás hozzárendelése
        $products = Product::where('vendor_id', $vendorId)
            ->where('subcategory_slug', $subcategorySlug)
            ->paginate($perPage);
        #dd($products);
        return view('frontend.vendor.vendor_product', compact('vendor', 'products', 'vendorId'));
    }



    public function VendorTermekKereses(Request $request){


        $perPage = 10;
        // Az id kinyerése a session-ből
        $vendorId = session('vendor_id');
       
        // Az eladó termékeinek lekérése a megadott kategória slug alapján
        $vendor = User::findOrFail($vendorId);



     
        $item = $request->search;
        #dd($item);
        $products = Product::where('product_name','LIKE',"%$item%")->where('vendor_id', $vendorId);
        $products = $products->paginate($perPage);

        $newProduct = Product::orderBy('id', 'DESC')->limit(3)->get();    

      return view('frontend.vendor.vendor_product_search', compact('vendor', 'products', 'vendorId', 'newProduct'));
    }



    public function VendorTermekRendezes(Request $request){



        $perPage = 10;
        $item = $request->searchQuery;
        #dd($item);
        $rendezes = $request->input('rendezes'); // A rendezési érték kinyerése
        
        #$minden = $request->all();

        $vendorId = session('vendor_id');
        $vendor = User::findOrFail($vendorId);

        $subcategory_slug = $request->input('subcategory_slug'); 
        #dd($subcategory_slug);

        $products = Product::where('status', 1)
        ->where('product_name', 'LIKE', "%$item%")
        ->where('vendor_id', $vendorId)
        ->where('subcategory_slug',$subcategory_slug);

    if (!empty($rendezes)) {
        if ($rendezes === 'arszerint-novekvo') {
            $products->orderByRaw('CASE WHEN discount_price > 0 THEN discount_price ELSE selling_price END ASC')->where('product_name', 'LIKE', "%$item%")->where('vendor_id', $vendorId)->where('subcategory_slug', $subcategory_slug);
        } elseif ($rendezes === 'arszerint-csokkeno') {
            $products->orderByRaw('CASE WHEN discount_price > 0 THEN discount_price ELSE selling_price END DESC')->where('product_name', 'LIKE', "%$item%")->where('vendor_id', $vendorId)->where('subcategory_slug', $subcategory_slug);
        } elseif ($rendezes === 'diszkont') {
            $products->whereNotNull('discount_price')->orderBy('discount_price', 'desc')->where('product_name', 'LIKE', "%$item%")->where('vendor_id', $vendorId)->where('subcategory_slug', $subcategory_slug);
        }
    }


        $products = $products->paginate($perPage); 
        $newProduct = Product::orderBy('id', 'DESC')->limit(3)->get();


      return view('frontend.vendor.vendor_product_search', compact('vendor', 'products', 'subcategory_slug','vendorId', 'newProduct'));
    }




    //Eladó oldalán lévő Rendezés input funkciója
    public function VendorProductArrangement(Request $request){


    $perPage = 10;
    $vendorId = session('vendor_id');
    #dd($vendorId);
    $slug = $request->input('subcategory_slug');
    #dd($slug);

    $category_id = $request->input('category_id');
    $rendezes = $request->input('rendezes'); // A rendezési érték kinyerése
    #dd($rendezes);
    $vendor = User::where('id', $vendorId)->first();

    // Lekérdezés az adott kategóriához tartozó termékekre
    $products = Product::where('status', 1)
        ->where('vendor_id', $vendorId)
        ->where('subcategory_slug', $slug);
    if (!empty($rendezes)) {
        if ($rendezes === 'arszerint-novekvo') {
            $products->orderByRaw('CASE WHEN discount_price > 0 THEN discount_price ELSE selling_price END ASC');
        } elseif ($rendezes === 'arszerint-csokkeno') {
            $products->orderByRaw('CASE WHEN discount_price > 0 THEN discount_price ELSE selling_price END DESC');
        } elseif ($rendezes === 'diszkont') {
            $products->whereNotNull('discount_price')->orderBy('discount_price', 'desc');
        }
    }

    $products = $products->paginate($perPage); 

    return view('frontend.vendor.vendor_product_arrangement', compact('products', 'vendorId', 'vendor'));
}






public function getVendorProductsByProductName($id, $subcategorySlug){



    $perPage = 10;
    $vendorId = session('vendor_id');
    // Az eladó termékeinek lekérése a megadott kategória slug alapján
    $vendor = User::findOrFail($vendorId);
    /* Itt egy kis bug volt
    $product = Product::where('vendor_id', $vendorId)
        ->where('product_name', $subcategorySlug);

     -- Magyarázat:
     A hibaüzenet oka az, hogy a $product változó egy Eloquent lekérdezési objektumot (azaz egy "builder" objektumot) tartalmaz, 
     nem pedig egy konkrét adatot. Ennek oka az, hogy a where feltételeket használod a $product lekérdezéshez, 
     de még nem végezted el a lekérdezést.

    A $product objektum lekérdezését végrehajthatod a get metódussal, hogy valódi adatot kapj vissza, 
    és ne egy lekérdezési objektumot. Tehát módosítsd a kódot a következő módon:   
        |
        | 
        V
    */

    $product = Product::where('vendor_id', $vendorId)
    ->where('product_slug', $subcategorySlug)
    ->first(); // Itt használjuk a first() metódust a lekérdezés végrehajtásához

    /*
    Ezzel a módosítással a $product változóban a konkrét termék lesz, nem pedig egy lekérdezési objektum.

    Ezenkívül győződj meg róla, hogy a $product tényleg tartalmazza a product_name tulajdonságot, 
    különben másik nevet kell használnod a nézetben. Ha a product_name nem áll rendelkezésre, 
    akkor érdemes ellenőrizni a Product modelljét, hogy az adatbázis mezőnevek megfelelőek-e a modell attribútumokkal.*/

 
    $color = $product->product_color;
    $product_color = explode(',', $color);
    $size = $product->product_size;
    $product_size = explode(',', $size);

    #$product = Product::findOrFail($id);
    $cat_id = $product->category_id;
    $multImage = MultiImg::where('product_id', $product->id)->get();     

    $relatedProduct = Product::where('category_id', $cat_id)->where('id', '!=', $id)->orderBy('id', 'DESC')->limit(4)->get();

    return view('frontend.vendor.vendor_product_details', compact('vendor','product', 'product_color', 'product_size', 'multImage', 'relatedProduct'));
}






    public function VendorAll(){ 


        $perPage = 10; // Figyelem, komment. Itt adom meg, hogy hány termék legyen a lapozó egyetlen egy oldalán

        $vendors = User::where('status', 'active')->where('role', 'vendor')->orderBy('id', 'DESC');
        #dd($vendors);

        $vendors = $vendors->paginate($perPage);
        return view('frontend/vendor/vendor_all', compact('vendors'));
    }




public function CatWiseProduct(Request $request, $id, $slug){

    $perPage = 10; // Figyelem, komment. Itt adom meg, hogy hány termék legyen a lapozó egyetlen egy oldalán
    $products = Product::query();

    // Add filters based on query parameters
    $products->where('status', 1)->where('category_id', $id)->orderBy('id', 'DESC');

    $products = $products->paginate($perPage);

    $breadcat = Category::where('id', $id)->first();

    $newProduct = Product::orderBy('id', 'DESC')->limit(3)->get();

    // Komment: A category_view oldalon a user tájékoztatására szolgál. A kis navigációs nyíl. kategóra neve-> alkategória...
    $subcat = SubCategory::where('category_id', $id)->pluck('subcategory_name');

    // Lekérdezzük az aktuális kategóriához tartozó alkategóriákat
    $subcategories = SubCategory::where('category_id', $id)->get();
    #dd($subcategories);
    return view('frontend/product.category_view', compact('products', 'breadcat', 'newProduct', 'subcat', 'subcategories'));
}







// Ez fut le amikor a bal oldalon lévő alkategóriára kattintok
public function SubCatWiseProduct(Request $request, $id, $slug){

  

    $perPage = 10;
    
    // Lekérdezés alkategória azonosító alapján
    $products = Product::where('status', 1)->where('subcategory_id', $id)->where('subcategory_slug', $slug )->orderBy('id', 'DESC')->paginate($perPage);
    $categories = Category::orderBy('category_name', 'ASC')->paginate(10);

    $breadsubcat = SubCategory::where('id', $id)->first();
    #dd($breadsubcat);

    $newProduct = Product::orderBy('id', 'DESC')->limit(3)->get();
    $subcat = SubCategory::where('category_id', $id)->pluck('subcategory_name');
    #dd($breadsubcat);
    return view('frontend/product.subcategory_view', compact('products', 'categories', 'breadsubcat', 'newProduct', 'subcat'));
}

/*
    public function MainCategoriesWithPhotos(Request $request){


        $data = $request->all();
        dd($data);
    return view('frontend/product.subcategory_view');
    }
*/



public function ProductViewAjax($id){

    // A Product model funció nevek, relationship-ek....
    $product = Product::with('category', 'brand')->findOrFail($id);
    #dd($product);
    $color = $product->product_color;
    $product_color = $color ? explode(',', $color) : null;

    $size = $product->product_size;
    $product_size = $size ? explode(',', $size) : null;



    if ($product_color === '' && $product_size === '' || $product_color === NULL && $product_size === NULL) {

          $response = [
            'product' => $product,
            'emptyAttributes' => 'nincs' // Ha nincs szín és méret attribtuma a terméknek Ez van vizsgálva jQuery oldalon a válaszban...
    ];

    } else {
          $response = [
            'product' => $product,
            'color' => $product_color,
            'size' => $product_size,
    ];
    }

    return response()->json($response);
}





    public function ProductSearch(Request $request){

        $request->validate(['search' => 'required']);

        $item = $request->search;
        $categories = Category::orderBy('category_name', 'ASC')->get();
        $newProduct = Product::orderBy('id', 'DESC')->limit(3)->get();
        $products = Product::where('product_name', 'LIKE', "%$item%")->get();

        return view('frontend.product.search', compact('products', 'item','categories','newProduct'));

        }




     
     public function SearchProduct(Request $request){  


        #$request->validate(['search' => "required"]);
        #dd($request);
        $item = $request->search;
        $products = Product::where('product_name','LIKE',"%$item%")->select('product_name','product_slug','product_thumbnail','selling_price','id')->limit(6)->get();

        return view('frontend.product.search_product',compact('products'));

     }



     
     public function SearchVendor(Request $request) {  


       $item = $request->search;
       $vendor = User::where('name', 'LIKE', "%$item%")->where('role', 'vendor')->get();

       return view('frontend.vendor.search_vendor', compact('vendor'));
}





     // Ez fut le amikor a szűrés selectre kattintok
     public function SearchProductSub(Request $request) {

        $data = $request->all();

        $perPage = 10;
      
        // Kérésből kiolvasott értékek
        $category_id = $data['category_id'];


        $product_subcategory_slug = $request->input('product_subcategory_slug');
         if($product_subcategory_slug ){

       // Lekérdezés az adott kategóriához tartozó termékekre
        $products = Product::where('status', 1)->where('subcategory_slug', $data['subcategory_slug'])->where('subcategory_slug', $product_subcategory_slug);
        }

        $products = Product::where('status', 1)->where('subcategory_slug', $data['subcategory_slug']);
  
        // Ár szerinti rendezés
        if (!empty($data['rendezes'])) {
            if ($data['rendezes'] === 'arszerint-novekvo') {
                $products->orderByRaw('CASE WHEN discount_price > 0 THEN discount_price ELSE selling_price END ASC');
            } elseif ($data['rendezes'] === 'arszerint-csokkeno') {
                $products->orderByRaw('CASE WHEN discount_price > 0 THEN discount_price ELSE selling_price END DESC');
            } elseif ($data['rendezes'] === 'diszkont') {
                $products->whereNotNull('discount_price')->orderBy('discount_price', 'desc');
            }
        }

    // Ezt hozzáadhatod, hogy visszaadjuk a $products változót is a nézetnek
        $products = $products->paginate($perPage);

        // További változók hozzáadása a kompaktba, ha szükséges
        $breadsubcat = SubCategory::where('category_id', $category_id)->first();
        #dd($breadsubcat);
        $categories = Category::orderBy('category_name', 'ASC')->limit(6)->get(); // Ha szükséges
        $newProduct = Product::orderBy('id', 'DESC')->limit(3)->get();

        return view('frontend/product.subcategory_view', compact('products', 'breadsubcat', 'categories', 'newProduct'));
}


    public function MobilKereses(Request $request){

        $perPage = 10;
        $item = $request->search;

        $product_subcategory_slug = $request->input('product_subcategory_slug');



        #######################################################################

        /* Figyelem. Ha nem így lenne ahogy, most akkor az összevissza keresgetések után egy ponton nem a név keresésre nem kapnánk vissza semmit sem*/
        if($product_subcategory_slug){
        $products = Product::where('product_name','LIKE',"%$item%")->where('subcategory_slug', $product_subcategory_slug);
        $products = $products->paginate($perPage);
        }

        $products = Product::where('product_name','LIKE',"%$item%");


        #######################################################################




        $products = $products->paginate($perPage);
        $newProduct = Product::orderBy('id', 'DESC')->limit(3)->get();

        return view('frontend.product.mobil_search_product',compact('products', 'newProduct','item'));

    }


    public function MobilRendezes(Request $request){



        $perPage = 10;
        $item = $request->searchQuery;
        $rendezes = $request->input('rendezes'); // A rendezési érték kinyerése
        $products = Product::where('status', 1)->where('product_name', 'LIKE', "%$item%");



    if (!empty($rendezes)) {
        if ($rendezes === 'arszerint-novekvo') {
            $products->orderByRaw('CASE WHEN discount_price > 0 THEN discount_price ELSE selling_price END ASC')->where('product_name', 'LIKE', "%$item%");
        } elseif ($rendezes === 'arszerint-csokkeno') {
            $products->orderByRaw('CASE WHEN discount_price > 0 THEN discount_price ELSE selling_price END DESC')->where('product_name', 'LIKE', "%$item%");
        } elseif ($rendezes === 'diszkont') {
            $products->whereNotNull('discount_price')->orderBy('discount_price', 'desc')->where('product_name', 'LIKE', "%$item%");
        }
    }


        $products = $products->paginate($perPage); 
        $newProduct = Product::orderBy('id', 'DESC')->limit(3)->get();
        return view('frontend.product.mobil_search_product',compact('products', 'newProduct','item'));
    }   
    
    
    public function Promo(){
        
          return view('frontend.promo.promo_site');
        
    }

}
    