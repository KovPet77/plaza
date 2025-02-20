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



class ShopController extends Controller
{
    

    public function ShopPage(){


        $products = Product::query();


        // Komment. Kategória filter kérés a Shop/Üzlet oldalon:
        if (!empty($_GET['category'])) {
            
            $slugs = explode(',', $_GET['category']);
            $catIds = Category::select('id')->whereIn('category_slug', $slugs)->pluck('id')->toArray();
            $products = Product::whereIn('category_id', $catIds)->get();
        } 

        elseif (!empty($_GET['brand'])) {
            
            $slugs = explode(',', $_GET['brand']);
            $brandIds = Brand::select('id')->whereIn('brand_slug', $slugs)->pluck('id')->toArray();
            $products = Product::whereIn('brand_id', $brandIds)->get();
        } else{

        // Az összeset mutatja ha nincs bepipálva egyik kategória sem:    
        $products = Product::where('status', 1)->orderBy('id', 'DESC')->get();

        }

        // Price Range:
        if (!empty($_GET['price'])) {
            $price = explode('-', $_GET['price']);
            $products = $products->whereBetween('selling_price', $price);
        }



        $categories = Category::orderBy('category_name', 'ASC')->get(); 
        $brands = Brand::orderBy('brand_name', 'ASC')->get(); 
        $newProduct = Product::orderBy('id', 'DESC')->limit(3)->get();

        return view('frontend/product.shop_page', compact('products', 'categories','newProduct', 'brands'));
    }



    public function ShopFilter(Request $request){
        
        $data = $request->all();
        
        // Kategória filterezés
        $catUrl = "";

        if (!empty($data['category'])) {
            
            foreach($data['category'] as $category){
                if (empty($catUrl)) {
                    $catUrl .= '&category='.$category;
                }else{
                    $catUrl .= ','.$category;
                }
            }
        }
        // Márka filterezés
        $brandUrl = "";

        if (!empty($data['brand'])) {
            
            foreach($data['brand'] as $brand){
                if (empty($brandUrl)) {
                    $brandUrl .= '&brand='.$brand;
                }else{
                    $brandUrl .= ','.$brand;
                }
            }
        }
        // Range filterezés
        $priceRangeUrl = "";
        if (!empty($data['price_range'])) {
             $priceRangeUrl .=  '&price='.$data['price_range'];
         } 
        return redirect()->route('shop.page', $catUrl.$brandUrl.$priceRangeUrl);
    }
}
