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
                'status' => true,
                'order' => 1
            ],
            [
                'client_id' => $clientIds[array_rand($clientIds)],
                'testimonial_text' => 'The insights provided by their analysis have been crucial for our business strategy. Highly recommended for any company looking to understand customer feedback.',
                'rating' => 5,
                'position' => 'CEO',
                'status' => true,
                'order' => 2
            ],
            [
                'client_id' => $clientIds[array_rand($clientIds)],
                'testimonial_text' => 'Working with BeneVita has been a game-changer for our product development cycle. We now truly understand what our customers want.',
                'rating' => 4,
                'position' => 'Product Manager',
                'status' => true,
                'order' => 3
            ],
            [
                'client_id' => $clientIds[array_rand($clientIds)],
                'testimonial_text' => 'Their customer insights are unparalleled, and have driven our decision-making process to be more data-focused.',
                'rating' => 5,
                'position' => 'Data Analyst',
                'status' => true,
                'order' => 4
            ],
            [
                'client_id' => $clientIds[array_rand($clientIds)],
                'testimonial_text' => 'BeneVita\'s expertise in sentiment analysis has given us a competitive edge. We understand our clients better than ever.',
                'rating' => 5,
                'position' => 'Head of Customer Experience',
                'status' => true,
                'order' => 5
            ],
            [
                'client_id' => $clientIds[array_rand($clientIds)],
                'testimonial_text' => 'The level of detail in their reports is astounding. We\'ve been able to pivot our strategy quickly and effectively.',
                'rating' => 4,
                'position' => 'Strategy Consultant',
                'status' => true,
                'order' => 6
            ],
            [
                'client_id' => $clientIds[array_rand($clientIds)],
                'testimonial_text' => 'Their approach to customer feedback has been revolutionary for our company culture.',
                'rating' => 5,
                'position' => 'HR Manager',
                'status' => true,
                'order' => 7
            ],
            [
                'client_id' => $clientIds[array_rand($clientIds)],
                'testimonial_text' => 'BeneVita Consulting has helped us align our products with market needs efficiently.',
                'rating' => 4,
                'position' => 'Operations Manager',
                'status' => true,
                'order' => 8
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
