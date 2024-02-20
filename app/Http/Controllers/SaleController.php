<?php

namespace App\Http\Controllers;

use App\DataTables\SaleDataTable;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use App\Models\Product;
use App\Models\ProductPrice;
use App\Models\Sale;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SaleDataTable $dataTable)
    {
        return $dataTable->render('promocoes.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        // Obtenha o valor da sessão "store"
        $storeId = session("store");

        // Consulta para obter apenas os produtos associados à loja com ID igual a $storeId
        $products = Product::whereHas('stores', function ($query) use ($storeId) {
            $query->where('stores.id', $storeId);
        })->pluck('title', 'id');


        return view('promocoes.create')->with(compact('products'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaleRequest $request)
    {
        $requestData = $request->all();

        // CASO O MODEL DA PROMOÇÃO SEJA PP, ELE VAI criar uma instância de product_price, criará uma instância de promoção que conterá: ['product', 'price_product', 'description', 'model', 'trigger', 'negative']
        if ($requestData['model']  === "PP") {
            ProductPrice::create([
                'product_id' => intval($requestData['product_id']),
                'isSale' => true,
                'price' => $requestData['price_product'],
            ]);

            Sale::create($request->all());
        }


        // CASO O MODEL DA PROMOÇÃO SEJA PXLY, ELE SÓ VAI CRIAR UMA INSTÂNCIA DE SALE
        if ($requestData['model']  === "PXLY") {
            Sale::create($request->all());
        }

        return redirect()->route('promocoes.index')->with('success', 'Sale created successfully');


    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSaleRequest $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
