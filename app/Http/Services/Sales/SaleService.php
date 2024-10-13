<?php

namespace App\Http\Services\Sales;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\GetProductsByStoreRequest;
use App\Http\Requests\Sales\GetSalesByStoreRequest;
use App\Models\Sale;
use App\Models\Store;
use Illuminate\Http\JsonResponse;

class SaleService extends Controller
{

    public function getSaleByStore(int $storeId): JsonResponse
    {

        // Busca os produtos associados à loja específica pelo relacionamento `stores`
        $sales = Sale::whereHas('stores', function ($query) use ($storeId) {
            $query->where('store_id', $storeId);
        })->get();

        // Retorna a resposta JSON
        return response()->json([
            'store' => $storeId,
            'sales' => $sales,
        ]);
    }


}
