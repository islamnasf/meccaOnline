<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelDetail extends Model
{
 protected $guarded=[];
    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }

    // علاقة مع نوع العنصر
    public function itemType()
    {
        return $this->belongsTo(ItemType::class, 'item_type_id');
    }
}
