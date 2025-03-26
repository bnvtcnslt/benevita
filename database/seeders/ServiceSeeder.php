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
        // Clear existing data
        DB::table('services')->truncate();

        $faker = Faker::create();

        // Get or create teams
        $teams = Team::all();
        if ($teams->isEmpty()) {
            $teams = Team::factory(5)->create();
        }

        $services = [
            'Web Development',
            'Mobile App Development',
            'UI/UX Design',
            'Digital Marketing',
            'Cloud Solutions',
            'E-commerce Solutions',
            'IT Consulting',
            'Data Analytics',
            'Cybersecurity',
            'AI & Machine Learning'
        ];

        foreach ($services as $serviceName) {
            Service::create([
                'title' => $serviceName,
                'description' => $faker->paragraphs(3, true),
                'image' => 'test1.jpg',
                'team_id' => $teams->random()->id,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
