<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipDistricts extends Model
{
    use HasFactory;
    protected $guarded = [];





        public function division()
    {

        // Relationship(kapcsolódás). Kapcsolódás neve: division....
        // A ship_districts táblában lévő division_id oszlop összekötése a
        // ship_divisions tábla id mezőjével
        return $this->belongsTo(ShipDivision::class, 'division_id', 'id');

    }
}
