<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hall>
 */
class HallFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $hall = 'Hall ';
        return [
            'title' => $hall . fake()->numberBetween(100, 150),
            'rows' => fake()->numberBetween(4, 15),
            'places' => fake()->numberBetween(4, 20),
            'normal_price' => fake()->randomFloat(2, 200.00, 400.00),
            'vip_price' => fake()->randomFloat(2, 500.00, 800.00)
        ];
    }
}
