<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Routes extends Model
{
   protected $table = '_routes'; //  هاد الموديل لاي جدول تابع هاد القصد هون

    protected $fillable =      //  يلي  مسموح للمستخدم يعبيها  هون الصفات الموجودة بالجدول
     [
        'start_Point',
        'End_Point',
        'route_name',

    ];




   public function trips()
{
    return $this->hasMany(Trip::class); // مسار له عدة رحلات
}



}
