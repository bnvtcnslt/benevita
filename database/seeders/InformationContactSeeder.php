<?php

namespace Database\Seeders;

use App\Models\InformationContact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InformationContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InformationContact::create([
            'address' => 'Jl. Sleman No. 123, Yogyakarta',
            'phone' => '+62 123 4567 890',
            'email' => 'info@benevita.com'
        ]);
    }
}
