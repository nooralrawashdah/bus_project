<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
   protected $table ='_booking';
   protected $filleable =
   [
       'Date',
       'Users_id',
       'Trip_id',


   ];

   public function user()
   {
    return $this->belongsTo('users'::class,'user_id');
   }
    public function trip()
    {
        return $this->belongsTo(Trip::class, 'trip_id');
    }
}
