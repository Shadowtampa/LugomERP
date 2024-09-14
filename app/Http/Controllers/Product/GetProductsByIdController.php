<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Services\Product\GetProductsService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class GetProductsByIdController extends Controller
{

    public function __construct(protected GetProductsService $getProducts)
    {
    }


    /**
     * @OA\Get(
     *     path="/product/getproductsbyid/{product}",
     *     tags={"product"},
     *     summary="Get Products by ID",
     *     description="Retrieve a list of products by their ID. Returns a list of products associated with the specified store ID.",
     *     operationId="getProductsById",
     *     @OA\Parameter(
     *         name="product",
     *         in="path",
     *         description="ID of the product to retrieve",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             example=1
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="store",
     *                 type="integer",
     *                 example=1
     *             ),
     *             @OA\Property(
     *                 property="products",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="id",
     *                         type="integer",
     *                         example=1
     *                     ),
     *                     @OA\Property(
     *                         property="title",
     *                         type="string",
     *                         example="Sample Product"
     *                     ),
     *                     @OA\Property(
     *                         property="price",
     *                         type="number",
     *                         format="float",
     *                         example=19.99
     *                     ),
     *                     @OA\Property(
     *                         property="promotionalPrice",
     *                         type="number",
     *                         format="float",
     *                         example=15.99
     *                     ),
     *                     @OA\Property(
     *                         property="image",
     *                         type="string",
     *                         example="https://example.com/image.jpg"
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Product not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Product not found"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Internal server error"
     *             )
     *         )
     *     )
     * )
     */
    public function __invoke(int $productId): JsonResponse
    {
        return $this->getProducts->getProductsById($productId);
    }
}
