<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    public function run()
    {
        Room::create(['name' => 'sala1', 'color' => '#1f8ef1']);
        Room::create(['name' => 'sala2', 'color' => '#10b981']);
        Room::create(['name' => 'sala3', 'color' => '#f59e0b']);
        /*Room::factory()->createMany([
            ['name' => 'sala1', 'color' => '#1f8ef1'],
            ['name' => 'sala2', 'color' => '#10b981'],
            ['name' => 'sala3', 'color' => '#f59e0b'],
        ]);*/
    }
}
