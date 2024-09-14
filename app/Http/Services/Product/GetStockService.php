<?php

namespace App\Http\Services\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\GetProductsByStoreAndProductRequest;
use App\Http\Requests\Product\GetProductsByStoreRequest;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetStockService extends Controller
{

    public function getStockByStore(GetProductsByStoreRequest $request): JsonResponse
    {

        $stocks = Store::whereId($request->get('store_id'))->first()->stocks();

        // Retorna a resposta JSON
        return response()->json([
            "stock" => $stocks
        ]);
    }
    public function getStockByStoreAndProduct(int $storeId, int $productId): JsonResponse
    {

        // Busca os estoques que pertencem à loja e ao produto específico
        $stocks = Store::whereId($storeId)->first()->stocks()->where('product_id', $productId)->first();

        // Retorna a resposta JSON
        return response()->json([
            "stock" => $stocks
        ]);
    }

}