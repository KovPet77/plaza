<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];



        // Ez a home_new_product.blade.php miatt kell, ott van használva...{{$product['vendor']['name']}}
        
   #                          ___________________________
   #                          |                          |   Tehát a blade-ben a ['category'] az az itt lévő funkció neve...
        public function category(){ // {{$product['category']['category_name']}}
       
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }



    public function vendor(){ 
        
      return $this->belongsTo(User::class, 'vendor_id', 'id'); // A Products táblában lévő vendor_id, megyegyezik a User táblában lévő id-val...
    }




    public function subcategory(){ 
        
      return $this->belongsTo(SubCategory::class, 'subcategory_id', 'id'); 
    }



        public function brand(){ 
        
      return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

}   
