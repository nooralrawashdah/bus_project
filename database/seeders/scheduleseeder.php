<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Schedules;

class SchedulesSeeder extends Seeder
{
    public function run(): void
    {
        Schedules::create([
            'scheduled_start' => '2025-12-24 08:00:00',
            'scheduled_end' => '2025-12-24 10:00:00',
            'bus_id' => 1,
            'trip_id' => 1
        ]);

        Schedules::create([
            'scheduled_start' => '2025-12-24 12:00:00',
            'scheduled_end' => '2025-12-24 14:00:00',
            'bus_id' => 2,
            'trip_id' => 2
        ]);
    }
}
