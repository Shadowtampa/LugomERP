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
    public function __construct(protected GetProductsByStoreService $getProductsByStoreService) {
    }

    public function __invoke(GetProductsByStoreRequest $request): JsonResponse
    {
        return $this->getProductsByStoreService->getProductsByStore($request);
    }

}
