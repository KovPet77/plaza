<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;


use App\Models\Category;
use App\Models\SubCategory;
use App\Models\MultiImg;
use App\Models\Brand;
use App\Models\Product;
use App\Models\User;
use Image;
use Carbon\Carbon;




class VendorProductController extends Controller
{
    


    public function VendorAllProduct()
    {

        $id = Auth::user()->id;
        $products = Product::where('vendor_id', $id)->latest()->get();
        return view('vendor.backend.product.vendor_product_all', compact('products'));
    }




    public function VendorAddProduct()
    {
     
        $brands = Brand::latest()->get();   
        $categories = Category::latest()->get();   
        return view('vendor.backend.product.vendor_product_add', compact('brands', 'categories'));
    }


    public function VendorGetSubCategory($category_id)
    {
        $subcat = SubCategory::where('category_id',$category_id)->orderBy('subcategory_name', 'ASC')->get();
        
        return json_encode($subcat);
    }


    public function VendorStoreProduct(Request $request)
    {
        
        #dd($request);

        $image = $request->file('product_thumbnail');
        $name_generate = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();        
        Image::make($image)->resize(800,800)->save('upload/products/thumbnail/'.$name_generate);
        $save_url = 'upload/products/thumbnail/'.$name_generate;


        $product_id = Product::insertGetId([

            'brand_id' => 1,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),
             'subcategory_slug' => 'pizza',

            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags' => $request->product_tags,
            'product_size' => $request->product_size,
            'product_color' => $request->product_color,


            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_desc' => $request->short_desc,
            'long_desc' => $request->long_desc,



            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offers' => $request->special_offers,
            'special_deals' => $request->special_deals,



            'product_thumbnail' => $save_url,
            'vendor_id' => Auth::user()->id, // Ez az egy különbség az admin ProdutController-hez képest, minden más ugyanaz
            'status' => 1,
            'created_at' => Carbon::now(),



        ]);

        $images = $request->file('multi_img');

        foreach($images as $img){
            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();        
            Image::make($img)->resize(800,800)->save('upload/products/multi-image/'.$make_name);

            $upload_path = 'upload/products/multi-image/'.$make_name;

            MultiImg::insert([

                'product_id' => $product_id,
                'photo_name' => $upload_path,
                'created_at' => Carbon::now(),


            ]);
        }

        $notification = array(
            'message'    => 'Eladói termék sikeresen létrehozva',
            'alert-type' => 'success'
        );

        return redirect()->route('vendor.all.product')->with($notification);

    }

    public function VendorEditProduct($id)
    {
        $multiImgs = MultiImg::where('product_id', $id)->get();       
        $brands = Brand::latest()->get();   
        $categories = Category::latest()->get();   
        $subcategory = Subcategory::latest()->get();   
        $products = Product::findOrFail($id);
        return view('vendor.backend.product.vendor_product_edit', compact('brands', 'categories', 'products', 'subcategory', 'multiImgs'));
    }




    public function VendorUpdateProduct(Request $request)
    {
        $product_id = $request->id;

        Product::findOrFail($product_id)->update([

            'brand_id' => 1,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),


            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags' => $request->product_tags,
            'product_size' => $request->product_size,
            'product_color' => $request->product_color,


            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_desc' => $request->short_desc,
            'long_desc' => $request->long_desc,



            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offers' => $request->special_offers,
            'special_deals' => $request->special_deals,

            
          
            'status' => 1,
            'created_at' => Carbon::now(),



        ]);

        $notification = array(
            'message'    => 'Eladói Termék sikeresen frissítve',
            'alert-type' => 'success'
        );

        return redirect()->route('vendor.all.product')->with($notification);

    }


    public function VendorUpdateProductThumbnail(Request $request)
    {
        $pro_id   = $request->id;
        $oldImage = $request->old_img;

        $image = $request->file('product_thumbnail');
        $name_generate = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();        
        Image::make($image)->resize(800,800)->save('upload/products/thumbnail/'.$name_generate);
        $save_url = 'upload/products/thumbnail/'.$name_generate;

        // Előző fotó eltávolítása:
        if(file_exists($oldImage)){
            unlink($oldImage);
        }

        Product::findOrFail($pro_id)->update([

            'product_thumbnail' => $save_url,
            'updated_at'        => Carbon::now()
        ]);

        $notification = array(
            'message'    => 'Thumbnail fotó sikeresen frissítve',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    
    public function VendorUpdateProductMultiimage(Request $request)
    {
        $imgs = $request->multi_img;

        foreach($imgs as $id => $img){

            $imgDel = MultiImg::findOrFail($id);
            unlink($imgDel->photo_name);
            
            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();        
            Image::make($img)->resize(800,800)->save('upload/products/multi-image/'.$make_name);

            $upload_path = 'upload/products/multi-image/'.$make_name;

            MultiImg::where('id', $id)->update([ // Update a multi_imgs táblában, ahol az id megegyezik a kérés id-jával...

                'photo_name' => $upload_path,
                'updated_at' => Carbon::now(),
            ]);
        }

            $notification = array(
                'message'    => 'Termék fotó sikeresen frissítve',
                'alert-type' => 'success'
            );
            
            return redirect()->back()->with($notification);
        }



        public function VendorMultiImageDelete($id)
        {
            $old_img = MultiImg::findOrFail($id);
            unlink($old_img->photo_name);
            MultiImg::findOrFail($id)->delete();

            $notification = array(
                'message'    => 'Termék fotó sikeresen törölve',
                'alert-type' => 'success'
            );
            
            return redirect()->back()->with($notification);

        }


        public function VendorProductInactive($id)
        {
            Product::findOrFail($id)->update(['status' => 0]);
            $notification = array(

                'message'    => 'Termék sikeresen inaktiválva',
                'alert-type' => 'success'
            );
            
            return redirect()->back()->with($notification);
        }



        public function VendorProductActive($id)
        {
            Product::findOrFail($id)->update(['status' => 1]);
            $notification = array(
                
                'message'    => 'Termék sikeresen aktiválva',
                'alert-type' => 'success'
            );
            
            return redirect()->back()->with($notification);
        }




        public function VendorDeleteProduct($id)
        {
            $product = Product::findOrFail($id);
            
            unlink($product->product_thumbnail);
            
            Product::findOrFail($id)->delete();
            $images = MultiImg::where('product_id', $id)->get();

            foreach($images as $image){
                unlink($image->photo_name);
                MultiImg::where('product_id', $id)->delete();
            }

            $notification = array(
                
                'message'    => 'Termék sikeresen törölve',
                'alert-type' => 'success'
            );
            
            return redirect()->back()->with($notification);
        }


}
