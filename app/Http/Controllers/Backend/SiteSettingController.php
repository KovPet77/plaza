<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteSetting;
use App\Models\Banner;
use App\Models\SEO;
use Image;



class SiteSettingController extends Controller
{
    


    public function SiteSetting(){

        $setting = SiteSetting::find(1);
        return view('backend.setting.setting_update', compact('setting'));

    }  




    // Oldal adatianak frissítése
    public function SiteSettingUpdate(Request $request){



        $setting_id = $request->id;      

        if($request->file('logo')){

            $image = $request->file('logo');
            $name_generate = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            
            Image::make($image)->resize(180,56)->save('upload/logo/'.$name_generate);

            $save_url = 'upload/logo/'.$name_generate;
        

            SiteSetting::findOrFail($setting_id)->update([

                'support_phone' => $request->support_phone,
                'phone_one' => $request->phone_one,
                'email' => $request->email,
                'company_address' => $request->company_address,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'youtube' => $request->youtube,
                'copyright' => $request->copyright,             
                'logo' =>  $save_url,             

            ]);

            // Toast message frissítéskor
            $notification = array(
                'message'    => 'Oldal adatai sikeresen frissítve fotóval együtt!',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
            
           }else{

            
            SiteSetting::findOrFail($setting_id)->update([

                'support_phone' => $request->support_phone,
                'phone_one' => $request->phone_one,
                'email' => $request->email,
                'company_address' => $request->company_address,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'youtube' => $request->youtube,
                'copyright' => $request->copyright,             
                       
                
                
            ]);
            
            // Toast message frissítéskor
            $notification = array(
                'message'    => 'Oldal adatai sikeresen, kivétel a fotó!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }

    }


    public function SeoSetting(){

     $seo = SEO::find(1);
    return view('backend.seo.seo_setting_update', compact('seo'));

    }


    public function SeoSettingUpdate(Request $request){


        $seo_id = $request->id;

        SEO::findOrFail($seo_id)->update([

        'meta_title' => $request->meta_title,
        'meta_author' => $request->meta_author,
        'meta_keyword' => $request->meta_keyword,
        'meta_description' => $request->meta_description,                  
                     
        
    ]);
    $notification = array(
    'message'    => 'Meta adatok sikeresen frissítve!',
    'alert-type' => 'success'
            );
    return redirect()->back()->with($notification);

    }

}
 