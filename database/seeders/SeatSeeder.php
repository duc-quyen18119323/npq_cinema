<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Seat;

class SeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seats = [];
        // 4 phòng, mỗi phòng 8 hàng (A-H), mỗi hàng 10 ghế
        for ($room = 1; $room <= 4; $room++) {
            foreach (range('A', 'H') as $row) {
                for ($num = 1; $num <= 10; $num++) {
                    $type = ($row == 'H') ? 'sweetbox' : (($row == 'D' || $row == 'E') ? 'vip' : 'normal');
                    $seats[] = [
                        'room_id' => $room,
                        'seat_number' => $row . $num,
                        'type' => $type,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
        }
        \App\Models\Seat::insert($seats);
    }
}
