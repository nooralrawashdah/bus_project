<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bus;

class BusSeeder extends Seeder
{
    public function run(): void
    {
        Bus::create([
            'plat_number' => '123ABC',
            'driver_id' => 1
        ]);

        Bus::create([
            'plat_number' => '456DEF',
            'driver_id' => 2
        ]);
    }
}
