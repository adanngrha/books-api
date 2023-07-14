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
            'user_id' => $this->faker->numberBetween(1, 2),
            'isbn' => $this->faker->isbn13,
            'title' => $this->faker->sentence(3),
            'subtitle' => $this->faker->sentence(5),
            'author' => $this->faker->name,
            'published' => $this->faker->date(),
            'publisher' => $this->faker->company,
            'pages' => $this->faker->numberBetween(100, 500),
            'description' => $this->faker->paragraph(),
            'website' => $this->faker->url,
        ];
    }
}
