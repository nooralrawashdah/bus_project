<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Drivers;

class DriversSeeder extends Seeder
{
    public function run(): void
    {
        Drivers::create([
            'Driver_Name' => 'Ali Hasan',
            'Driver_Phone' => '0771234567',
            'Driver_license_num' => 'A12345'
        ]);

        Drivers::create([
            'Driver_Name' => 'Sara Khaled',
            'Driver_Phone' => '0799876543',
            'Driver_license_num' => 'B67890'
        ]);
    }
}
