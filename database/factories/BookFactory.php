<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake('en_US')->name(),
            'edition' => fake()->randomNumber(1, true),
            'author' => fake('en_US')->name(),
            'year' => fake()->numberBetween(1990, 2023),
            'category' => fake()->text(8)
        ];
    }
}
