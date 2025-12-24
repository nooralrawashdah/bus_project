<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;   // جدول الرحلات
use App\Models\Seat;   // جدول المقاعد (إذا موجود)

class DriverDashboardController extends Controller
{
    public function index()
    {
        // جلب جميع الرحلات اليومية (مثلاً اليوم الحالي)
        $trips = Trip::withCount('bookedSeats') // افتراض: علاقة bookedSeats في الموديل
                     ->whereDate('trip_date', now())
                     ->get();

        // تجهيز بيانات لكل رحلة
        $tripData = $trips->map(function($trip) {
            return [
                'trip_number'  => $trip->id,
                'route'        => $trip->route,
                'time'         => $trip->departure_time,
                'seats_booked' => $trip->bookedSeats_count, // عدد المقاعد المحجوزة
                'total_seats'  => $trip->total_seats,
                'status'       => $trip->bookedSeats_count >= $trip->total_seats 
                                  ? 'Ready' 
                                  : ($trip->started ? 'In Progress' : 'Waiting'),
            ];
        });

        // حساب إجمالي المقاعد للمركبة الأولى مثلاً
        $firstTrip = $trips->first();
        $totalSeats  = $firstTrip->total_seats ?? 45;
        $seatsBooked = $firstTrip->bookedSeats_count ?? 0;
        $tripStarted = $firstTrip->started ?? false;

        return view('driver.dashboard', [
            'seats_booked' => $seatsBooked,
            'total_seats'  => $totalSeats,
            'trip_started' => $tripStarted,
            'trips'        => $tripData,
        ]);
    }
}
