<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use HasFactory, SoftDeletes;

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
