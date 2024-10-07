<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Facility;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                'image' => 'category-headers/hotel.png',
            ],
            [
                'name' => 'Car Rental',
                'image' => 'category-headers/car.png',
            ],
            [
                'name' => 'Museums',
                'image' => 'category-headers/museum.png',
            ],
            [
                'name' => 'Gyms',
                'image' => 'category-headers/gym.png',
            ],
            [
                'name' => 'Marketplace',
                'image' => 'category-headers/market.png',
            ],
        ];

        DB::table('categories')->insert($categories);
        
        foreach (Category::cursor() as $category) {
            Facility::factory(5)->create([
                'category_id' => $category->id
            ]);
        }
    }
}
