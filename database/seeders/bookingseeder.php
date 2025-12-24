<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        Booking::create([
            'Date' => '2025-12-24',
            'user_id' => 1,
            'trip_id' => 1
        ]);
    }
}
