<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Routes;

class RoutesSeeder extends Seeder
{
    public function run(): void
    {
        Routes::create([
            'route_name' => 'Amman to Zarqa',
            'Start_point' => 'Amman',
            'End_point' => 'Zarqa'
        ]);

        Routes::create([
            'route_name' => 'Irbid to Amman',
            'Start_point' => 'Irbid',
            'End_point' => 'Amman'
        ]);
    }
}
