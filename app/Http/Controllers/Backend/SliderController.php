<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Image;

class SliderController extends Controller
{
    






    public function AllSlider()
    {
         // Latest data megszerzése a Category modeltől:
        $sliders = Slider::latest()->get();
        return view('backend.slider.slider_all', compact('sliders'));
    }






    public function AddSlider()
    {
        // $activeVendor = User::where('status','active')->where('role','vendor')->latest()->get();
        // $brands = Brand::latest()->get();   
        // $categories = Category::latest()->get();   
        return view('backend.slider.add_slider');

    }


    public function SliderStore(Request $request)
    {
        $image = $request->file('slider_image');
        $name_generate = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        
        Image::make($image)->resize(2376,807)->save('upload/slider/'.$name_generate);

        $save_url = 'upload/slider/'.$name_generate;

        Slider::insert([

            'slider_title' => $request->slider_title,
            'short_title' =>  $request->short_title,
            'slider_image' => $save_url,
            

        ]);

        // Toast message frissítéskor
        $notification = array(
            'message'    => 'Slider sikeresen létrehozva',
            'alert-type' => 'success'
        );

        return redirect()->route('all.slider')->with($notification);
    }




    public function EditSlider($id)
    {
        $sliders = Slider::findOrFail($id);
        //dd($category);
        return view('backend.slider.slider_edit', compact('sliders'));
    }





    public function UpdateSlider(Request $request){


        $slider_id = $request->id;
        $old_image = $request->old_img;

        if($request->file('slider_image')){

            $image = $request->file('slider_image');
            $name_generate = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        
            Image::make($image)->resize(2376,807)->save('upload/slider/'.$name_generate);
    
            $save_url = 'upload/slider/'.$name_generate;

            // A régi kép eltávolítása a mappából, ha a fotót is frissíteni akarja:
            if(file_exists($old_image)){
                unlink($old_image);
            }

            Slider::findOrFail($slider_id)->update([

                'slider_title' => $request->slider_title,
                'short_title' =>  $request->short_title,
                'slider_image' => $save_url,                

            ]);

            // Toast message frissítéskor
            $notification = array(
                'message'    => 'Slider sikeresen frissítve!',
                'alert-type' => 'success'
            );

            return redirect()->route('all.slider')->with($notification);

    }else{

        Slider::findOrFail($slider_id)->update([

            'slider_title' => $request->slider_title,
            'short_title' =>  $request->short_title,
                     

        ]);
        
        // Toast message frissítéskor
        $notification = array(
            'message'    => 'Slider sikeresen szerkesztve, kivétel a fotó!',
            'alert-type' => 'success'
        );
        return redirect()->route('all.slider')->with($notification);
    }

}




        public function DeleteSlider($id)
        {
            $slider = Slider::findOrFail($id);
            $img = $slider->slider_image;
            unlink($img);

            Slider::findOrFail($id)->delete();

            $notification = array(
                'message'    => 'Slider sikeresen törölve!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
}
