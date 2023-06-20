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
            'title' => fake('en_US')->text(10),
            'isbn' => fake()->randomNumber(5, true),
            'summary' => fake('en_US')->paragraph(1),
            'publish_date' => fake()->numberBetween(1990, 2023),
        ];
    }
}
