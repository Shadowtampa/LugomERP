<?php

namespace App\Http\Controllers;

use App\DataTables\ProductPriceDataTable;
use App\Http\Requests\StoreProductPriceRequest;
use App\Http\Requests\UpdateProductPriceRequest;
use App\Models\ProductPrice;

class ProductPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProductPriceDataTable $dataTable)
    {
        return $dataTable->render('productprice.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('productprices.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductPriceRequest $request)
    {
        $requestData = $request->all();


        // Verifica se "isSale" está presente no array, se não estiver, define como false
        $isSale = isset($requestData['isSale']) ? true : false;


        // Cria o modelo ProductPrice com os dados do request
        $productPrice = ProductPrice::create([
            'product_id' => intval($requestData['page_id']),
            'isSale' => $isSale,
            'price' => $requestData['price'],
        ]);

        // Redirect to a view or route after successfully storing the product
        return redirect("produtos{$requestData['page_id']}")->with('success', 'Price created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(ProductPrice $productPrice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductPrice $productPrice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductPriceRequest $request, ProductPrice $productPrice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductPrice $productPrice)
    {
        //
    }
}
