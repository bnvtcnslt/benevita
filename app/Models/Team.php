<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image'
    ];


    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function members()
    {
        return $this->hasMany(TeamMember::class)->withTrashed();
    }
}
