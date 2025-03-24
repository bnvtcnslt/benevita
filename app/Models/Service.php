<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'image',
        'team_id'
    ];

    /**
     * Get the team that owns the service.
     */
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
