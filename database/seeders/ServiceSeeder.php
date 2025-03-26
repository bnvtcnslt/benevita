<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Team;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        DB::table('services')->truncate();

        $faker = Faker::create();

        // Get teams (assuming there are already teams in the database)
        $teams = DB::table('teams')->get();

        // Service data
        $services = [
            [
                'title' => 'Web Development',
                'description' => $faker->paragraphs(3, true),
                'image' => 'test1.jpg',
                'team_id' => $teams->first()->id, // Change to the team_id you want to assign
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Mobile App Development',
                'description' => $faker->paragraphs(3, true),
                'image' => 'test2.jpg',
                'team_id' => $teams->first()->id, // Same as above
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'UI/UX Design',
                'description' => $faker->paragraphs(3, true),
                'image' => 'test3.jpg',
                'team_id' => $teams->first()->id, // Same as above
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        // Insert services into the services table
        DB::table('services')->insert($services);
    }
}
