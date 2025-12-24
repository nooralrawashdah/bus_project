<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Trips;

class TripsSeeder extends Seeder
{
    public function run(): void
    {
        Trips::create([
            'start_time' => '08:00:00',
            'end_time' => '10:00:00',
            'bus_id' => 1,
            'route_id' => 1
        ]);

        Trips::create([
            'start_time' => '12:00:00',
            'end_time' => '14:00:00',
            'bus_id' => 2,
            'route_id' => 2
        ]);
    }
}
