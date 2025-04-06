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
            'logo' => '/storage/images/brand/Iphone.png',
        ]);

        Brand::create([
            'brandName' => 'SamSung',
            'logo' => '/storage/images/brand/SamSung.png',
        ]);

        Brand::create([
            'brandName' => 'Honor',
            'logo' => '/storage/images/brand/Honor.png',
        ]);

        Brand::create([
            'brandName' => 'Nokia',
            'logo' => '/storage/images/brand/Nokia.png',
        ]);

        Brand::create([
            'brandName' => 'Oppo',
            'logo' => '/storage/images/brand/Oppo.png',
        ]);

        Brand::create([
            'brandName' => 'Realme',
            'logo' => '/storage/images/brand/Realme.png',
        ]);

        Brand::create([
            'brandName' => 'Vivo',
            'logo' => '/storage/images/brand/Vivo.png',
        ]);

        Brand::create([
            'brandName' => 'Xiaomi',
            'logo' => '/storage/images/brand/Xiaomi.png',
        ]);
    }
}