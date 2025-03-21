<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('clients')->insert([
            [
                'name' => 'Client',
                'email' => 'client@gmail.com',
                'phone' => '123456789',
                'address' => 'Address',
                'logo_img' => 'logo.png',
                'created_at' => now(),
                'status' => true
            ],
            [
                'name' => 'Client 2',
                'email' => 'client2@gmail.com',
                'phone' => '123456789',
                'address' => 'Address',
                'logo_img' => 'logo.png',
                'created_at' => now(),
                'status' => true
            ]
        ]);
    }
}
