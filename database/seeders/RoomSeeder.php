<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Room::insert([
            [
                'name' => 'Phòng 1',
                'total_seats' => 40,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Phòng 2',
                'total_seats' => 40,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Phòng 3',
                'total_seats' => 40,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Phòng 4',
                'total_seats' => 40,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
