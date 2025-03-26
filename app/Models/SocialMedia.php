<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SocialMedia extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['platform', 'url'];

    public static function getAllowedPlatforms()
    {
        return
            ['Facebook', 'TikTok', 'Instagram', 'LinkedIn', 'Whatsapp',
            'Github','Twitter-X', 'YouTobe', 'Telegram', 'Discord'];
    }
}
