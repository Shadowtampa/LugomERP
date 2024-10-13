<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Http\Services\Sales\SaleService;
use Illuminate\Http\Request;

class GetSalesByStoreController extends Controller
{
    public function __construct(private SaleService $saleService ) {
    }

    public function __invoke(int $saleId){
        return $this->saleService->getSaleByStore($saleId);

    }
}
