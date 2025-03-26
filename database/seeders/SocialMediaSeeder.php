<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('social_media')->insert([
            [
                'platform' => 'Facebook',
                'url' => 'https://www.facebook.com',
                'status' => 1
            ],
            [
                'platform' => 'TikTok',
                'url' => 'https://www.tiktok.com',
                'status' => 1
            ],
            [
                'platform' => 'Instagram',
                'url' => 'https://www.instagram.com',
                'status' => 1
            ],
            [
                'platform' => 'LinkedIn',
                'url' => 'https://www.linkedin.com',
                'status' => 1
            ],
            [
                'platform' => 'Whatsapp',
                'url' => 'https://www.whatsapp.com',
                'status' => 1
            ],
            [
                'platform' => 'Github',
                'url' => 'https://www.github.com',
                'status' => 1
            ],
            [
                'platform' => 'Twitter-X',
                'url' => 'https://www.twitter.com',
                'status' => 1
            ],
            [
                'platform' => 'YouTube',
                'url' => 'https://www.youtube.com',
                'status' => 1
            ],
            [
                'platform' => 'Telegram',
                'url' => 'https://www.telegram.org',
                'status' => 1
            ],
            [
                'platform' => 'Discord',
                'url' => 'https://www.discord.com',
                'status' => 1
            ]
        ]);
    }
}
