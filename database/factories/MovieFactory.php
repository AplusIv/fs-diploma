<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $movie = 'Movie ';
        return [
            'title' => $movie . fake()->numberBetween(100, 150),
            'description' => fake()->sentence(50),
            'duration' => fake()->numberBetween(80, 150),
            'country' => fake()->country(),
        ];
    }
}
