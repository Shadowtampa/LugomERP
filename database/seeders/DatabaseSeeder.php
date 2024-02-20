<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        Product::factory(10)->create();

        // Crie o usuário
        User::factory()->create([
            "name" => "Luis Gomes",
            'email' => 'luis@gmail.com',
            'password' => bcrypt('senha123'),
        ]);

        // Crie a loja
        Store::factory()->create([
            'id' => 1,
            'title' => 'Loja 1',
        ]);

        // Associe o usuário à loja
        User::find(1)->stores()->attach(1);

        // Pegue 3 produtos aleatórios
        $products = Product::inRandomOrder()->take(3)->get();

        // Associe os produtos à loja (product_store)
        foreach ($products as $product) {
            $product->stores()->attach(1);
        }
        
    }
}
