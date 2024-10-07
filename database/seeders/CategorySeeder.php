<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Facility;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $categories = [
            [
                'name' => 'Hotels',
                'slug' => 'hotels',
                'image' => 'category-headers/hotel.png',
            ],
            [
                'name' => 'Car Rental',
                'slug' => 'car-rental',
                'image' => 'category-headers/car.png',
            ],
            [
                'name' => 'Museums',
                'slug' => 'museums',
                'image' => 'category-headers/museum.png',
            ],
            [
                'name' => 'Gyms',
                'slug' => 'gym',
                'image' => 'category-headers/gym.png',
            ],
            [
                'name' => 'Marketplace',
                'slug' => 'marketplace',
                'image' => 'category-headers/market.png',
            ],
        ];

        DB::table('categories')->insert($categories);
        
       
    }
}
