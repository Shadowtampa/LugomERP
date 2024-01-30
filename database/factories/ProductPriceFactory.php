<?php

namespace Database\Factories;

use App\Models\ProductPrice;
use App\Models\Product; // Certifique-se de importar o modelo Product
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductPriceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product = Product::factory()->create(); // Cria um produto no banco de dados e obtém o id

        return [
            'product_id' => $product->id,
            'isSale' => $this->faker->boolean,
            'price' => $this->faker->randomFloat(2, 10, 1000),
        ];
    }
}
