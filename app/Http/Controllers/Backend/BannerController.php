<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Image;




class BannerController extends Controller
{
    
    public function AllBanner()
    {
         // Latest data megszerzése a Category modeltől:
        $banners = Banner::latest()->get();
        return view('backend.banner.banner_all', compact('banners'));
    }


    
    public function AddBanner()
    {
        // $activeVendor = User::where('status','active')->where('role','vendor')->latest()->get();
        // $brands = Brand::latest()->get();   
        // $categories = Category::latest()->get();   
        return view('backend.banner.add_banner');

    }


    public function StoreBanner(Request $request)
    {
        $image = $request->file('banner_image');
        $name_generate = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        
        Image::make($image)->resize(768,450)->save('upload/banner/'.$name_generate);

        $save_url = 'upload/banner/'.$name_generate;

        Banner::insert([

            'banner_title' => $request->banner_title,
            'banner_url' =>  $request->banner_url,
            'banner_image' => $save_url,
            

        ]);

        // Toast message frissítéskor
        $notification = array(
            'message'    => 'Banner sikeresen létrehozva',
            'alert-type' => 'success'
        );

        return redirect()->route('all.banner')->with($notification);
    }



    public function EditBanner($id)
    {
        $banners = Banner::findOrFail($id);
        //dd($category);
        return view('backend.banner.banner_edit', compact('banners'));
    }



    public function UpdateBanner(Request $request){


        $banner_id = $request->id;
        $old_image = $request->old_img;

        if($request->file('banner_image')){

            $image = $request->file('banner_image');
            $name_generate = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();        
            Image::make($image)->resize(768,450)->save('upload/banner/'.$name_generate);    
            $save_url = 'upload/banner/'.$name_generate;

            // A régi kép eltávolítása a mappából, ha a fotót is frissíteni akarja:
            if(file_exists($old_image)){
                unlink($old_image);
            }

            Banner::findOrFail($banner_id)->update([

                'banner_title' => $request->banner_title,
                'banner_url' =>  $request->banner_url,
                'banner_image' => $save_url,                

            ]);

            // Toast message frissítéskor
            $notification = array(
                'message'    => 'Banner sikeresen frissítve!',
                'alert-type' => 'success'
            );

            return redirect()->route('all.banner')->with($notification);

    }else{

        Banner::findOrFail($banner_id)->update([

            'banner_title' => $request->banner_title,
            'banner_url' =>  $request->banner_url,                         

        ]);
        
        // Toast message frissítéskor
        $notification = array(
            'message'    => 'Banner sikeresen szerkesztve, kivétel a fotó!',
            'alert-type' => 'success'
        );
        return redirect()->route('all.banner')->with($notification);
    }

}




        public function DeleteBanner($id)
        {
            $banner = Banner::findOrFail($id);
            $img = $banner->banner_image;
            unlink($img);

            Banner::findOrFail($id)->delete();

            $notification = array(
                'message'    => 'Banner sikeresen törölve!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }

}
