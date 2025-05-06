<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Movie;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Movie::insert([
            [
                'title' => 'Avengers: Endgame',
                'description' => 'Biệt đội siêu anh hùng chống lại Thanos.',
                'trailer_url' => 'https://www.youtube.com/watch?v=TcMBFSGVi1c',
                'duration' => 181,
                'poster' => 'avengers_endgame.jpg',
                'status' => 'now_showing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Spider-Man: No Way Home',
                'description' => 'Peter Parker đối mặt đa vũ trụ.',
                'trailer_url' => 'https://www.youtube.com/watch?v=JfVOs4VSpmA',
                'duration' => 148,
                'poster' => 'spiderman_no_way_home.jpg',
                'status' => 'now_showing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Dune',
                'description' => 'Cuộc chiến trên hành tinh sa mạc.',
                'trailer_url' => 'https://www.youtube.com/watch?v=n9xhJrPXop4',
                'duration' => 155,
                'poster' => 'dune.jpg',
                'status' => 'coming_soon',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
