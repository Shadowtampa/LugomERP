<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'title' => $this->faker->sentence,
            'image_url' => $this->faker->imageUrl(),
            'description' => $this->faker->words(15, true),
            'category' => $this->faker->word,
        ];
    }
}
