<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category'=>fake()->name(),
            'provider'=>fake()->name(),
            'name'=>fake()->name(),
            'description'=>fake()->paragraph(2),
            'available'=>fake()->boolean(),
            'stock'=>fake()->numberBetween(1, 10)
        ];
    }
}
