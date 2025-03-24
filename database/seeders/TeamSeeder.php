<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Team::insert([
            [
                'name' => 'Team',
                'position' => 'Position',
                'image' => 'user.jpg',
                'created_at' => now(),
            ],
            [
                'name' => 'Team 2',
                'position' => 'Position',
                'image' => '1742733479_download (3).jpg',
                'created_at' => now(),
            ],
            [
                'name' => 'Team 3',
                'position' => 'Position',
                'image' => 'user.jpg',
                'created_at' => now(),
            ],
            [
                'name' => 'Team 4',
                'position' => 'Position',
                'image' => '1742733479_download (3).jpg',
                'created_at' => now(),
            ],
            [
                'name' => 'Team 5',
                'position' => 'Position',
                'image' => 'user.jpg',
                'created_at' => now(),
            ],
        ]);
    }
}
