<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients'; // Ensure this matches your actual table name

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'logo_img',
        'status'
    ];

    // Add this method for debugging
    public static function checkConnection() {
        try {
            $count = self::count();
            return [
                'success' => true,
                'count' => $count,
                'connection' => config('database.default'),
                'database' => config('database.connections.' . config('database.default') . '.database')
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
}
