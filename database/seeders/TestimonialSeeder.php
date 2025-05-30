<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all client IDs
        $clientIds = Client::pluck('id')->toArray();

        if (empty($clientIds)) {
            $this->command->info('No clients found. Please run the ClientSeeder first.');
            return;
        }

        $testimonials = [
            [
                'client_id' => $clientIds[array_rand($clientIds)],
                'testimonial_text' => 'BeneVita Consulting has transformed how we understand our customers. Their sentiment analysis has helped us improve our products significantly.',
                'rating' => 5,
                'position' => 'Marketing Director',
                'image' => 'test1.jpg',
                'status' => true,
                'order' => 1
            ],
            [
                'client_id' => $clientIds[array_rand($clientIds)],
                'testimonial_text' => 'The insights provided by their analysis have been crucial for our business strategy. Highly recommended for any company looking to understand customer feedback.',
                'rating' => 5,
                'position' => 'CEO',
                'image' => 'test2.jpg',
                'status' => true,
                'order' => 2
            ]
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
