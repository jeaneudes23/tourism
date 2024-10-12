<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'is_bookable' => fake()->boolean(8),
            'custom_text' => fake()->word(),
            'name' => fake()->word(),
            'description' => fake()->paragraph(),
            'unit_price' => fake()->randomFloat(2, 10, 1000),
            'unit' => fake()->word(), 
            'currency' => fake()->currencyCode(),
        ];
    }
}
