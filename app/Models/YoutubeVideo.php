<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YoutubeVideo extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'video_id',
        'url',
        'channel_url',
        'position_right',
        'is_active'
    ];

    protected $casts = [
        'position_right' => 'boolean',
        'is_active' => 'boolean'
    ];

    /**
     * Extract YouTube video ID from URL
     */
    public static function extractVideoId($url)
    {
        $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/';
        preg_match($pattern, $url, $matches);
        return $matches[1] ?? null;
    }
}
