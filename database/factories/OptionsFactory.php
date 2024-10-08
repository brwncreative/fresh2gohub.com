<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Options>
 */
class OptionsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'option' => fake()->name(),
            'value' => fake()->randomFloat(2, 9.99, 30),
            'product_id' => fake()->numberBetween(1, 3)
        ];
    }
}
