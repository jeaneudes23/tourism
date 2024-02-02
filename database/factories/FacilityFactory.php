<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Facility>
 */
class FacilityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name().rand(0,100),
            'slug' => fake()->word().rand(0,100),
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'tags' => implode(',', fake()->words(5)),
            'image' => 'facility-images/facility-header.jpg',
            'google_maps' => 'https://maps.app.goo.gl/SrmyAeXz5rF6gjoB8',
            'location' => fake()->randomElement(['Kigali','Gisenyi','Musanze','Butare']),
            'address' => fake()->address(),
            'website' => fake()->url(),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->email(),
        ];
    }
}
