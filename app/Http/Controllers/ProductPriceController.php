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

        // Cria o modelo ProductPrice com os dados do request
        $productPrice = ProductPrice::create([
            'product_id' => intval($requestData['page_id']),
            'price' => $requestData['price'],
        ]);

        // Redirect to a view or route after successfully storing the product
        return redirect("produtos/{$requestData['page_id']}")->with('success', 'Price created successfully');

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
    public function edit($id)
    {
        $price = ProductPrice::findOrFail($id);




        return view('productprices.edit', compact('price'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductPriceRequest $request, $id)
    {
        // Encontrar o produto pelo ID
        $price = ProductPrice::findOrFail($id);
    
        // Atualizar apenas os campos específicos permitidos no modelo
        $price->update([
            'price' => $request['price'],
        ]);
    
        return redirect("produtos/{$price->product_id}")->with('success', 'Price created successfully');

    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $price = ProductPrice::findOrFail($id);

        $product = $price->product_id;

        // Update the product with the validated data
        $price->delete();

        // Redirect to a view or route after successfully updating the product
        return redirect("produtos/{$product}")->with('success', 'Price created successfully');
        //
    }

    public function createSalePriceFromSaleController(){

    }
}
