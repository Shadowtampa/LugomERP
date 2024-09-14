<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\GetProductsByStoreRequest;
use App\Http\Services\Product\GetProductsByStoreService;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetProductsByStoreController extends Controller
{
    public function __construct(protected GetProductsByStoreService $getProductsByStoreService)
    {
    }

    /**
     * @OA\Get(
     *     path="/api/produto/getproductsbystore/{store}",
     *     tags={"product"},
     *     summary="Obter produtos de uma loja específica",
     *     description="Retorna uma lista de produtos de uma loja, filtrando pelo ID da loja.",
     *     operationId="getProductsByStore",
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
     *         description="Lista de produtos retornada com sucesso",
     *         @OA\JsonContent(
     *             @OA\Property(property="store", type="integer", example=1, description="ID da loja"),
     *             @OA\Property(
     *                 property="products",
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1, description="ID do produto"),
     *                     @OA\Property(property="title", type="string", example="Coca Gelada", description="Nome do produto"),
     *                     @OA\Property(property="price", type="number", format="float", example=179.9, description="Preço do produto"),
     *                     @OA\Property(property="promotionalPrice", type="number", format="float", example=161.91, description="Preço promocional do produto"),
     *                     @OA\Property(property="image", type="string", format="url", example="https://example.com/image.jpg", description="URL da imagem do produto")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Loja ou produtos não encontrados"
     *     )
     * )
     */
    public function __invoke(int $storeId): JsonResponse
    {
        return $this->getProductsByStoreService->getProductsByStore($storeId);
    }

}
