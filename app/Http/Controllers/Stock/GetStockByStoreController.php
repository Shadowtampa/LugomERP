<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\GetProductsByStoreRequest;
use App\Http\Services\Stock\GetStockService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetStockByStoreController extends Controller
{

    public function __construct(protected GetStockService $getStockByStoreService)
    {

    }

    /**
     * @OA\Get(
     *     path="/api/produto/getstockbystore/{store}",
     *     tags={"product"},
     *     summary="Obter estoque de uma loja específica",
     *     description="Retorna uma lista de estoques de todos os produtos disponíveis em uma loja, filtrando pelo ID da loja.",
     *     operationId="getStockByStore",
     *     @OA\Parameter(
     *         name="store",
     *         in="path",
     *         required=true,
     *         description="ID da loja",
     *         @OA\Schema(
     *             type="integer",
     *             example=1
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lista de estoques retornada com sucesso",
     *         @OA\JsonContent(
     *             @OA\Property(property="stock", type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1, description="ID do estoque"),
     *                     @OA\Property(property="amount", type="integer", example=10, description="Quantidade disponível no estoque")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Loja ou estoques não encontrados"
     *     )
     * )
     */
    public function __invoke(GetProductsByStoreRequest $request): JsonResponse
    {
        return $this->getStockByStoreService->getStockByStore($request);
    }
}
