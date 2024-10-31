<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Image;




class CategoryController extends Controller
{
    


    public function AllCategory()
    {
         // Latest data megszerzése a Category modeltől:
        $categories = Category::latest()->get();
        return view('backend.category.category_all', compact('categories'));
    }

    public function AddCategory()
    {
        return view('backend.category.category_add');
    }


 

    
    public function CategoryStore(Request $request)
    {
        $image = $request->file('category_image');
        $name_generate = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        
        Image::make($image)->resize(120,120)->save('upload/category/'.$name_generate);

        $save_url = 'upload/category/'.$name_generate;

        Category::insert([

            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
            'category_image' => $save_url,
            

        ]);

        // Toast message frissítéskor
        $notification = array(
            'message'    => 'Kategória sikeresen létrehozva',
            'alert-type' => 'success'
        );

        return redirect()->route('all.category')->with($notification);
    }


    public function EditCategory($id)
    {
        $category = Category::findOrFail($id);
        //dd($category);
        return view('backend.category.category_edit', compact('category'));
    }




    public function UpdateCategory(Request $request)

    {
        
        $category_id = $request->id;
        $old_image = $request->old_image;

        if($request->file('category_image')){

            $image = $request->file('category_image');
            $name_generate = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            
            Image::make($image)->resize(300,300)->save('upload/category/'.$name_generate);

            $save_url = 'upload/category/'.$name_generate;

            // A régi kép eltávolítása a mappából, ha a fotót is frissíteni akarja:
            if(file_exists($old_image)){
                unlink($old_image);
            }

            Category::findOrFail($category_id)->update([

                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
                'category_image' => $save_url,
                

            ]);

            // Toast message frissítéskor
            $notification = array(
                'message'    => 'Kategória sikeresen szerkesztve fotóval együtt!',
                'alert-type' => 'success'
            );

            return redirect()->route('all.category')->with($notification);
            
        }else{

            
            Category::findOrFail($category_id)->update([
                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),       
                
                
            ]);
            
            // Toast message frissítéskor
            $notification = array(
                'message'    => 'Kategória sikeresen szerkesztve, kivétel a fotó!',
                'alert-type' => 'success'
            );
            return redirect()->route('all.category')->with($notification);
        }
    }


    
    public function DeleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $img = $category->category_image;
        unlink($img);

        Category::findOrFail($id)->delete();

        $notification = array(
            'message'    => 'Kategória sikeresen törölve!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


}
