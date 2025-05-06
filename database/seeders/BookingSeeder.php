<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Booking;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Booking::insert([
            [
                'showtime_id' => 1,
                'seat_id' => 1,
                'customer_name' => 'Nguyễn Văn A',
                'customer_phone' => '0900000001',
                'status' => 'paid',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'showtime_id' => 1,
                'seat_id' => 2,
                'customer_name' => 'Trần Thị B',
                'customer_phone' => '0900000002',
                'status' => 'unpaid',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'showtime_id' => 2,
                'seat_id' => 3,
                'customer_name' => 'Lê Văn C',
                'customer_phone' => '0900000003',
                'status' => 'paid',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'showtime_id' => 2,
                'seat_id' => 4,
                'customer_name' => 'Phạm Thị D',
                'customer_phone' => '0900000004',
                'status' => 'unpaid',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'showtime_id' => 3,
                'seat_id' => 5,
                'customer_name' => 'Đỗ Văn E',
                'customer_phone' => '0900000005',
                'status' => 'paid',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
