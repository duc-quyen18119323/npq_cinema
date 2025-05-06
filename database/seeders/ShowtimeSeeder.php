<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Showtime;

class ShowtimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Showtime::insert([
            // Phim 1
            [
                'movie_id' => 1,
                'room_id' => 1,
                'show_date' => now()->toDateString(),
                'start_time' => '10:00:00',
                'end_time' => '12:30:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'movie_id' => 1,
                'room_id' => 2,
                'show_date' => now()->toDateString(),
                'start_time' => '14:00:00',
                'end_time' => '16:30:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Phim 2
            [
                'movie_id' => 2,
                'room_id' => 3,
                'show_date' => now()->addDay()->toDateString(),
                'start_time' => '17:00:00',
                'end_time' => '19:30:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'movie_id' => 2,
                'room_id' => 4,
                'show_date' => now()->addDay()->toDateString(),
                'start_time' => '20:00:00',
                'end_time' => '22:30:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Phim 3
            [
                'movie_id' => 3,
                'room_id' => 1,
                'show_date' => now()->addDays(2)->toDateString(),
                'start_time' => '09:00:00',
                'end_time' => '11:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'movie_id' => 3,
                'room_id' => 2,
                'show_date' => now()->addDays(2)->toDateString(),
                'start_time' => '13:00:00',
                'end_time' => '15:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
