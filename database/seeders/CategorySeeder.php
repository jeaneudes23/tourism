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
                'description' => "Explore a range of comfortable and luxurious accommodations.",
                'tags' => 'luxury,boutique,comfort,travel,hospitality',
                'image' => 'category-headers/hotels-header.jpg',
            ],
            [
                'name' => 'Car Rental',
                'description' => "Discover convenient and reliable car rental services.",
                'tags' => 'car,rental,car rental,travel,road trip',
                'image' => 'category-headers/car-rental-header.jpg',
            ],
            [
                'name' => 'Museums',
                'description' => 'Car rental services for exploring the city.',
                'tags' => 'Museums, Art and Culture, History Exploration, Educational Experiences, Cultural Exhibitions',
                'image' => 'category-headers/museum-header.jpg',
            ],
            [
                'name' => 'Gyms',
                'description' => 'Elevate your fitness journey with our selection of gyms and fitness centers.',
                'tags' => 'gym,fitness,health,wellness,exercise,training',
                'image' => 'category-headers/gyms-header.jpg',
            ],
            [
                'name' => 'NightClubs',
                'description' => 'Immerse yourself in the electric atmosphere of our vibrant nightlife and clubs.',
                'tags' => 'nightclub,nightlife,dance,entertainment',
                'image' => 'category-headers/clubs-header.jpg',
            ],
            [
                'name' => 'Marketplace',
                'description' => 'Explore the convenience of our urban marketplace.',
                'tags' => 'supermarkets,shops,Essentials,food,products',
                'image' => 'category-headers/markets-header.jpg',
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
