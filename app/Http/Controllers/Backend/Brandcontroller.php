<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Image;



class Brandcontroller extends Controller
{
    
    public function AllBrand()
    {
        // Latest data megszerzése a Brand modeltől:
        $brands = Brand::latest()->get();
        return view('backend.brand.brand_all', compact('brands'));
    }



    public function AddBrand()
    {
       
        return view('backend.brand.brand_add');
    }

    public function BrandStore(Request $request)
    {
        $image = $request->file('brand_image');
        $name_generate = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        
        Image::make($image)->resize(300,300)->save('upload/brand/'.$name_generate);

        $save_url = 'upload/brand/'.$name_generate;

        Brand::insert([

            'brand_name' => $request->brand_name,
            'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
            'brand_image' => $save_url,
            

        ]);

        // Toast message frissítéskor
        $notification = array(
            'message'    => 'Márka sikeresen létrehozva',
            'alert-type' => 'success'
        );

        return redirect()->route('all.brand')->with($notification);
    }


    public function EditBrand($id)
    {
        $brand = Brand::findOrFail($id);
        return view('backend.brand.brand_edit', compact('brand'));
    }


    public function UpdateBrand(Request $request)

    {
        
        $brand_id = $request->id;
        $old_image = $request->old_image;

        if($request->file('brand_image')){

            $image = $request->file('brand_image');
            $name_generate = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            
            Image::make($image)->resize(300,300)->save('upload/brand/'.$name_generate);

            $save_url = 'upload/brand/'.$name_generate;

            // A régi kép eltávolítása a mappából, ha a fotót is frissíteni akarja:
            if(file_exists($old_image)){
                unlink($old_image);
            }

            Brand::findOrFail($brand_id)->update([

                'brand_name' => $request->brand_name,
                'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
                'brand_image' => $save_url,
                

            ]);

            // Toast message frissítéskor
            $notification = array(
                'message'    => 'Márka sikeresen szerkesztve fotóval együtt!',
                'alert-type' => 'success'
            );

            return redirect()->route('all.brand')->with($notification);
            
        }else{

            
            Brand::findOrFail($brand_id)->update([
                'brand_name' => $request->brand_name,
                'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),       
                
                
            ]);
            
            // Toast message frissítéskor
            $notification = array(
                'message'    => 'Márka sikeresen szerkesztve, kivétel a fotó!',
                'alert-type' => 'success'
            );
            return redirect()->route('all.brand')->with($notification);
        }
    }


    public function DeleteBrand($id)
    {
        $brand = Brand::findOrFail($id);
        $img = $brand->brand_image;
        unlink($img);

        Brand::findOrFail($id)->delete();

        $notification = array(
            'message'    => 'Márka sikeresen törölve!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
