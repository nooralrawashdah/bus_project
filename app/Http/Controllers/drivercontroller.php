<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class drivercontroller extends Controller
{
    <?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function dashboard()
    {
        // بيانات تجريبية - بعدين تربط مع قاعدة البيانات
        $data = [
            'seats_booked' => 40,
            'trip_started' => false,
            'driver_name' => 'Ahmed Mohammed',
            'bus_number' => 'BUS-101',
            'today_trips' => [
                ['time' => '08:00 AM', 'route' => 'City Center → University', 'seats' => 40],
                ['time' => '02:00 PM', 'route' => 'University → Mall', 'seats' => 30],
                ['time' => '06:00 PM', 'route' => 'Mall → Airport', 'seats' => 15],
            ],
            'total_seats' => 40
        ];

        return view('driver.dashboard', $data);
    }

    // يمكن إضافة دوال أخرى لاحقاً
    public function startTrip()
    {
        //if(seats_booked >= 40)
           //
           //  return back()->with('true','trip started successfully');
    }

    public function viewSchedule()
    {

    }
}
}
