<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\GetProductsByStoreAndProductRequest;
use App\Http\Services\Product\GetStockService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetStockByStoreAndProductController extends Controller
{
    public function __construct(protected GetStockService $getStockService)
    {

    }

    /**
     * @OA\Get(
     *     path="/api/produto/getstockbystoreandproduct/{store_id}/{product_id}",
     *     tags={"product"},
     *     summary="Obter estoque de um produto específico em uma loja",
     *     description="Retorna o estoque de um produto específico em uma loja específica, filtrando pelos IDs da loja e do produto.",
     *     operationId="getStockByStoreAndProduct",
     *     @OA\Parameter(
     *         name="store_id",
     *         in="path",
     *         required=true,
     *         description="ID da loja",
     *         @OA\Schema(
     *             type="integer",
     *             example=1
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="product_id",
     *         in="path",
     *         required=true,
     *         description="ID do produto",
     *         @OA\Schema(
     *             type="integer",
     *             example=2
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Estoque do produto retornado com sucesso",
     *         @OA\JsonContent(
     *             @OA\Property(property="stock", type="object",
     *                 @OA\Property(property="id", type="integer", example=1, description="ID do estoque"),
     *                 @OA\Property(property="amount", type="integer", example=10, description="Quantidade disponível no estoque")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Estoque não encontrado"
     *     )
     * )
     */
    public function __invoke(int $storeId, int $producId): JsonResponse
    {
        return $this->getStockService->getStockByStoreAndProduct($storeId, $producId);
    }
}
