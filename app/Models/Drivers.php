<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Drivers extends Model
{
   protected $table= '_drivers';
    protected $fillable =      // هون الصفات الموجودة بالجدول
     [
        'Driver_Name',
        'Driver_Phone',
       ' Driver_illcense_num',

    ];
      public function bus()
    {
        return $this->hasOne(Bus::class, 'driver_id');
    }

}
