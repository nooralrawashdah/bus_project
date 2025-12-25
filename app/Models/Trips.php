<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trips extends Model
{
    protected $table = 'trips'; //  هاد الموديل لاي جدول تابع هاد القصد هون

    protected $fillable =      // هون الصفات الموجودة بالجدول
     [
        'start_time',
        'end_time',
        'bus_id',
        'route_id',
    ];

    public function bus()
    {
        return $this->belongsTo(Bus::class, 'bus_id');

    }
    public function route()
{
    return $this->belongsTo(Route::class,'route_id'); // كل رحلة لها مسار واحد
}
 public function scheduled()
{
    return $this->hasMany(Scheduled::class);
}

public function bookings()
{ return $this->hasMany(Booking::class, 'trip_id');
 }

}
