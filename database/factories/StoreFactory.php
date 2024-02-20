<?php
// StoreFactory.php
namespace Database\Factories;

use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

class StoreFactory extends Factory
{
    protected $model = Store::class;

    public function definition()
    {
        return [
            'title' => $this->faker->unique()->company,
        ];
    }
}
