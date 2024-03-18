<?php

namespace Database\Factories;

use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

class StoreFactory extends Factory
{
    protected $model = Store::class;

    public function definition()
    {
        return [
            'official_name' => $this->faker->unique()->company,
            'alias' => $this->faker->unique()->word,
            'address' => $this->faker->address,
            'description' => $this->faker->sentence,
            'contact' => $this->faker->phoneNumber,
            'owner' => $this->faker->name,
            'location' => $this->faker->latitude() . ', ' . $this->faker->longitude(), // Exemplo de coordenadas geográficas
        ];
    }
}
