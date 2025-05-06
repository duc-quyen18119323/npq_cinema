<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Gọi các seeder cho hệ thống rạp phim
        $this->call([
            MovieSeeder::class,
            RoomSeeder::class,
            SeatSeeder::class,
            ShowtimeSeeder::class,
            BookingSeeder::class,
            PaymentSeeder::class,
        ]);

        // Tùy chọn: tạo user mẫu
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
