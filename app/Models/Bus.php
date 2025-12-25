<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
     protected $table = '_bus';
      protected $fillable =      // هون الصفات الموجودة بالجدول
     [
        'plat_number',
        'Driver_id',
         

    ];

    public function seats()
{
    return $this->hasMany(Seat::class,'bus_id');
}

public function drivers()
{
    return $this->belongsTo(Driver::class, 'driver_id');
}
public function trips()
    {
        return $this->hasMany(Trip::class, 'bus_id'); // الباص له أكثر من رحلة
    }

public function scheduled()
{
    return $this->hasMany(Scheduled::class,'bus_id');
}


}
