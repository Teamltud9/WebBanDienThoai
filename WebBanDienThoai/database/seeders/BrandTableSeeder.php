<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::create([
            'brandName' => 'Iphone',
            'logo' => 'nike-logo.png',
            'isDeleted' => false,
        ]);

        Brand::create([
            'brandName' => 'Samsung',
            'logo' => 'adidas-logo.png',
            'isDeleted' => false,
        ]);

        Brand::create([
            'brandName' => 'Nokia',
            'logo' => 'puma-logo.png',
            'isDeleted' => false,
        ]);
    }
}
