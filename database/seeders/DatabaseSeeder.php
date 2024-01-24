<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
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
            'email' => 'youdes@test.dev',
            'phone' => '0787387250',
            'type' => 'admin',
            'password' => Hash::make('password'),
        ]);

        $locations = [['name'=> 'Kigali'],['name'=> 'Musanze'],['name'=> 'Gisenyi'],['name'=> 'Butare']];

        DB::table('locations')->insert($locations);
        


    }
}
