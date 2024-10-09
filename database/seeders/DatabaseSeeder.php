<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Facility;
use App\Models\FrontPageContent;
use App\Models\Post;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    // \App\Models\User::factory(10)->create();

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

    $locations = [['name' => 'Kigali'], ['name' => 'Musanze'], ['name' => 'Gisenyi'], ['name' => 'Butare']];

    DB::table('locations')->insert($locations);


    User::factory()->create([
      'name' => 'Admin',
      'email' => 'admin@test.com',
      'role' => 'admin',
      'password' => Hash::make('password'),
    ]);

    $manager = User::factory()->create([
      'name' => 'Manager',
      'email' => 'manager@test.com',
      'role' => 'manager',
      'password' => Hash::make('password'),
    ]);

    User::factory()->create([
      'name' => 'Customer',
      'email' => 'customer@test.com',
      'role' => 'customer',
      'password' => Hash::make('password'),
    ]);

    FrontPageContent::create([
      'title' => 'RWANDA TOURISM',
      'description' => "Embark on an unforgettable journey through the heart of Rwanda with 'Rwanda Roam Reviews,' your ultimate guide to the nation's most enchanting destinations.",
      'logo' => 'logo.png',
      'overlay' => 'overlay.png'
    ]);

    $categories = Category::get();

    foreach ($categories as $key => $category) {
      # code...
      for ($i=0; $i < 5; $i++) { 
        $facility = Facility::factory()->create();
        $facility->categories()->attach($category);
        $facility->managers()->attach($manager);
        Service::factory()->count(5)->create(['facility_id' => $facility->id]);

      }
    }
  }
}
