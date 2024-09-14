<?php

namespace App\Http\Services\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\GetProductsByStoreRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetProductsService extends Controller
{

    public function getProductsByStore(int $storeId): JsonResponse
    {
        // Busca os produtos associados à loja específica pelo relacionamento `stores`
        $products = Product::whereHas('stores', function ($query) use ($storeId) {
            $query->where('store_id', $storeId);
        })->get();

        // Mapeia os produtos para o formato desejado
        $formattedProducts = $products->map(function ($product) {
            return [
                "id" => $product->id,
                "title" => $product->title,
                "price" => $product->price(), // Ajuste se o campo for diferente no model
                "promotionalPrice" => 90, // Ajuste se o campo for diferente no model
                "image" => $product->image_url, // Usando 'image_url' conforme o model
            ];
        });

        // Retorna a resposta JSON
        return response()->json([
            'store' => $storeId,
            'products' => $formattedProducts,
        ]);
    }
    public function getProductsById(int $productId): JsonResponse
    {
        // Busca os produtos associados à loja específica pelo relacionamento `stores`
        $product = Product::whereId($productId)->first();

        // Mapeia os produtos para o formato desejado
        $formattedProduct = [
            "id" => $product->id,
            "title" => $product->title,
            "price" => $product->price(), // Ajuste se o campo for diferente no model
            "promotionalPrice" => 90, // Ajuste se o campo for diferente no model
            "image" => $product->image_url, // Usando 'image_url' conforme o model
        ];

        // Retorna a resposta JSON
        return response()->json([
            'store' => $productId,
            'product' => $formattedProduct,
        ]);
    }

}
