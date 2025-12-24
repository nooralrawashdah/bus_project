<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Seates;

class SeatesSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            Seates::create([
                'Seat_number' => $i,
                'bus_id' => 1
            ]);

            Seates::create([
                'Seat_number' => $i,
                'bus_id' => 2
            ]);
        }
    }
}
