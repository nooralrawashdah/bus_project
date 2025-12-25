<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seates extends Model
 {  protected $table = '_seates';
      protected $fillable =      // هون الصفات الموجودة بالجدول
     [
        'seat_id',
        'Seat_number',
        'bus_id',

    ];





   public function buses()
{
    return $this->belongsToMany(Bus::class, 'bus_seat');
}
}
