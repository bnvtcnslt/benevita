<?php

namespace Database\Seeders;

namespace Database\Seeders;

use App\Models\YouTubeVideo;
use Illuminate\Database\Seeder;

class YoutubeVideoSeeder extends Seeder
{
    public function run()
    {
        YouTubeVideo::create([
            'title' => 'Kenali Benevita Consulting',
            'description' => 'Benevita Consulting membantu bisnis Anda memahami pelanggan lebih baik melalui analisis sentimen berbasis AI. Video ini menjelaskan bagaimana kami menggunakan teknologi artificial intelligence untuk menganalisa umpan balik pelanggan dan mengubahnya menjadi wawasan yang dapat ditindaklanjuti.',
            'video_id' => 'MZ2aHpZtCNo',
            'url' => 'https://www.youtube.com/watch?v=MZ2aHpZtCNo',
            'position_right' => false,
            'channel_url' => 'https://www.youtube.com/@BeneVitaConsulting',
        ]);

        YouTubeVideo::create([
            'title' => 'Layanan Analisis Sentimen Kami',
            'description' => 'Video ini memperlihatkan bagaimana layanan analisis sentimen kami membantu bisnis memahami apa yang dibicarakan pelanggan mereka. Dengan menganalisis data dari berbagai sumber, kami membantu Anda mengidentifikasi tren, peluang, dan area yang memerlukan perhatian lebih.',
            'video_id' => 'dQw4w9WgXcQ',
            'url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'position_right' => true,
            'channel_url' => 'https://www.youtube.com/@BeneVitaConsulting',
        ]);
    }
}
