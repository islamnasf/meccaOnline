<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemType extends Model
{
 protected $guarded=[];
    public function hotel_detail(){
      return $this->belongsTo(HotelDetail::class,'item_type_id');
    }
    public function hotel(){
      return $this->belongsTo(Hotel::class);
    }
}
