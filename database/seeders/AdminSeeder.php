<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
            'name' => 'Quản trị viên',
            'username' => 'admin',
            'password' => Hash::make('password123'), // Đổi mật khẩu phức tạp hơn khi dùng thực tế
        ]);
    }
}
