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
                'name' => 'Luxe Retreats & Hotels',
                'description' => "Explore a range of comfortable and luxurious accommodations tailored to meet your travel needs. Whether you're seeking a lavish stay or a cozy boutique hotel, our curated selection ensures a memorable and enjoyable experience during your journey.",
                'tags' => 'luxury,boutique,comfort,travel,hospitality',
                'image' => 'category-headers/hotels-header.jpg',
            ],
            [
                'name' => 'Car Rental Companies',
                'description' => "Discover convenient and reliable car rental services for seamless exploration. Whether you're looking for a compact car for city adventures or an SUV for scenic drives, our trusted car rental partners offer a diverse fleet to suit every travel preference.",
                'tags' => 'car,rental,car rental,travel,road trip',
                'image' => 'category-headers/car-rental-header.jpg',
            ],
            [
                'name' => 'Museums & Cultural Exhibitions',
                'description' => 'Car rental services for exploring the city.',
                'tags' => 'Museums, Art and Culture, History Exploration, Educational Experiences, Cultural Exhibitions',
                'image' => 'category-headers/museum-header.jpg',
            ],
            [
                'name' => 'Fitness Centers & Gyms',
                'description' => 'Elevate your fitness journey with our selection of state-of-the-art gyms and fitness centers. From cutting-edge equipment to expert trainers, experience a health and wellness haven designed to empower your physical well-being.',
                'tags' => 'gym,fitness,health,wellness,exercise,training',
                'image' => 'category-headers/gyms-header.jpg',
            ],
            [
                'name' => 'Vibrant Nightlife & Clubs',
                'description' => 'Immerse yourself in the electric atmosphere of our vibrant nightlife and clubs. From pulsating beats to stylish ambiance, our selection of nightclubs promises an exhilarating experience for those seeking unforgettable evenings filled with music, dance, and energy.',
                'tags' => 'nightclub,nightlife,dance,entertainment',
                'image' => 'category-headers/clubs-header.jpg',
            ],
            [
                'name' => 'Marketplace',
                'description' => ' Explore the convenience of our urban marketplace, featuring a curated selection of supermarkets and shops. From fresh produce to everyday essentials, discover a diverse range of products in a welcoming and accessible environment.',
                'tags' => 'supermarkets,shops,Essentials,food,products',
                'image' => 'category-headers/markets-header.jpg',
            ],
        ];

        DB::table('categories')->insert($categories);
        
        foreach (Category::cursor() as $category) {
            Facility::factory(10)->create([
                'category_id' => $category->id
            ]);
        }
    }
}
