<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\FrontPageContent;
use App\Models\Post;
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

        User::factory()->create([
            'name' => 'Youdes',
            'email' => 'admin@test.com',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);

        FrontPageContent::create([
            'title' => 'RWANDA TOURISM',
            'description' => "Embark on an unforgettable journey through the heart of Rwanda with 'Rwanda Roam Reviews,' your ultimate guide to the nation's most enchanting destinations.",
            'logo' => 'logo.png',
            'overlay' => 'overlay.png'
        ]);

        $locations = [['name'=> 'Kigali'],['name'=> 'Musanze'],['name'=> 'Gisenyi'],['name'=> 'Butare']];

        DB::table('locations')->insert($locations);
        
    }
}
