<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class schedules extends Model
{
   protected $table='schedules';
   protected $fillable =      // هون الصفات الموجودة بالجدول
     [
        'scheduled_start',
        'bus_id',
        'trip_id',
       'scheduled_end',
    ];
     public function trip()
    {
        return $this->belongsTo(Trip::class, 'trip_id');
    }


    public function bus()
    {
        return $this->belongsTo(Bus::class, 'bus_id');
    }
}
