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
            'title' => fake()->sentence(),
            'description' => fake()->paragraphs(5 , true),
            'tags' => implode(',', fake()->words(5)),
            'image' => 'facility-images/facility-header.jpg',
            'google_maps' => '<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3987.4860977915587!2d30.1034799!3d-1.9591479!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19dca655c2157919%3A0x563092512616ce2!2sH%C3%B4tel%20Chez%20Lando!5e0!3m2!1sen!2srw!4v1706973837440!5m2!1sen!2srw" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
            'location' => fake()->randomElement(['Kigali','Gisenyi','Musanze','Butare']),
            'address' => fake()->address(),
            'website' => fake()->url(),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->email(),
        ];
    }
}
