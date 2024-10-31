<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipState extends Model
{
    use HasFactory;
    protected $guarded = [];



        // Ezek a state.all.blade.php-ban vannak felhasználva a foreach-ben
      public function division(){


        return $this->belongsTo(ShipDivision::class, 'division_id', 'id');

    }




       public function district(){

      
        return $this->belongsTo(ShipDistricts::class, 'district_id', 'id');

    }
}
