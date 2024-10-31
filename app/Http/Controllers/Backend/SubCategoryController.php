<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use Image;



class SubCategoryController extends Controller
{
    

    public function AllSubCategory()
    {
         // Latest data megszerzése a Category modeltől:
        $subcategories = SubCategory::latest()->get();

        #dd($subcategories);
        return view('backend.subcategory.subcategory_all', compact('subcategories'));
    }
    
    
    public function AddSubCategory()
    {
        // Itt a kategóriákat kell kiszedni ezért a Category model...
        $categories = Category::orderBy('category_name', 'ASC')->get();
        return view('backend.subcategory.subcategory_add', compact('categories'));

    }





    public function StoreSubCategory(Request $request)
    {   
               
         #dd($request);      
        $image = $request->file('subcategory_image');
        $name_generate = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

        Image::make($image)->resize(120,120)->save('upload/subcategory/'.$name_generate);
        $save_url = 'upload/subcategory/'.$name_generate;

         SubCategory::insert([
            'subcategory_image' => $save_url,
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => strtolower(str_replace(' ', '-', $request->subcategory_name))
            

        ]);

        // Toast message frissítéskor
        $notification = array(
            'message'    => 'Alkategória sikeresen létrehozva',
            'alert-type' => 'success'
        );

        return redirect()->route('all.subcategory')->with($notification);
    }


    public function EditSubCategory($id)
    {


        $categories = Category::orderBy('category_name', 'ASC')->get();
        $subcategory = SubCategory::findOrFail($id);
        //dd($category);
        return view('backend.subcategory.subcategory_edit', compact('categories', 'subcategory'));
    }

    public function UpdateSubCategory(Request $request)
    {
        $subcat_id = $request->id;

        SubCategory::findOrFail($subcat_id)->update([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => strtolower(str_replace(' ', '-', $request->subcategory_name))
            

        ]);

        // Toast message frissítéskor
        $notification = array(
            'message'    => 'Alkategória sikeresen frissítve',
            'alert-type' => 'success'
        );

        return redirect()->route('all.subcategory')->with($notification);
    }


    public function DeleteSubCategory($id)
    {
        SubCategory::findOrFail($id)->delete();
        $notification = array(
            'message'    => 'Alkategória sikeresen törölve',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


        /*

    public function GetSubCategory($category_id)
    {
        $subcat = SubCategory::where('category_id', $category_id)
            ->orderBy('subcategory_name', 'ASC')
            ->get(['subcategory_name', 'subcategory_slug']); // Válaszban a subcategory_name és subcategory_slug oszlopokat lekérem

        return json_encode($subcat);
    }

    */

public function GetSubCategory($category_id)
{
    $subcat = SubCategory::where('category_id', $category_id)
        ->orderBy('subcategory_name', 'ASC')
        ->get(['id', 'subcategory_name', 'subcategory_slug']); // Lekérdezéshez adjuk hozzá az 'id' oszlopot is

    return json_encode($subcat);
}




}
