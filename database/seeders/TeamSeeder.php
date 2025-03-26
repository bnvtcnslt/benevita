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
                'description' => 'Position',
                'image' => 'test2.jpg',
                'created_at' => now(),
            ],
            [
                'name' => 'Team 2',
                'description' => 'Position',
                'image' => 'test1.jpg',
                'created_at' => now(),
            ],
            [
                'name' => 'Team 3',
                'description' => 'Position',
                'image' => 'test2.jpg',
                'created_at' => now(),
            ],
            [
                'name' => 'Team 4',
                'description' => 'Position',
                'image' => 'test1.jpg',
                'created_at' => now(),
            ],
            [
                'name' => 'Team 5',
                'description' => 'Position',
                'image' => 'test2.jpg',
                'created_at' => now(),
            ],
        ]);
    }
}
