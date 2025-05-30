<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('team_members')->insert([
            [
                'name' => 'John Doe',
                'role' => 'Developer',
                'image' => 'test1.jpg',
                'created_at' => now(),
                'team_id' => 1,
            ],
            [
                'name' => 'Jane Doe',
                'role' => 'Designer',
                'image' => 'test2.jpg',
                'created_at' => now(),
                'team_id' => 2,
            ]
        ]);
    }
}
