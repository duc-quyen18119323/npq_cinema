<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Payment;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Payment::insert([
            [
                'booking_id' => 1,
                'amount' => 120000,
                'payment_method' => 'cash',
                'payment_time' => now(),
                'status' => 'completed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'booking_id' => 3,
                'amount' => 150000,
                'payment_method' => 'momo',
                'payment_time' => now(),
                'status' => 'completed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'booking_id' => 5,
                'amount' => 200000,
                'payment_method' => 'banking',
                'payment_time' => now(),
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
