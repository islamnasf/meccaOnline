<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
   protected $guarded=[];
   public function users()
{
    return $this->belongsToMany(User::class, 'hotel_user', 'hotel_id', 'user_id')
                ->withTimestamps();
}
  public function order()
    {
        return $this->hasMeny(Order::class, 'hotel_id');
    }
      public function items()
    {
        return $this->hasMeny(HotelDetail::class, 'hotel_id');
    }
}
