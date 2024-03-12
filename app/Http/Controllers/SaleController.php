<?php

namespace App\Http\Controllers;

use App\DataTables\SaleDataTable;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use App\Models\Product;
use App\Models\ProductPrice;
use App\Models\Sale;
use App\Models\SaleDetail;
use Illuminate\Support\Facades\Session;

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

        $sale = Sale::create([
            'description' => $requestData['description'],
            'model' => $requestData['model'],
        ]);

        $sale_detail = SaleDetail::create([
            'sale_id' => $sale->id
        ]);


        // CASO O MODEL DA PROMOÇÃO SEJA PP, ELE VAI criar uma instância de product_price, criará uma instância de promoção que conterá: ['product', 'price_product', 'description', 'model', 'trigger', 'negative']
        if ($requestData['model']  === "PP") {
            $product_price = ProductPrice::create(
                [
                    'product_id' => $requestData['product_id'],
                    'price' => $requestData['price_product']
                ]
            );

            $sale_detail->product_price_id = $product_price->id;
            $sale_detail->save();
        }


        // CASO O MODEL DA PROMOÇÃO SEJA PXLY, ELE SÓ VAI CRIAR UMA INSTÂNCIA DE SALE
        if ($requestData['model']  === "PXLY") {

            $sale_detail->trigger_id = $requestData['trigger_id'];
            $sale_detail->trigger = $requestData['trigger'];

            $sale_detail->negative_id = $requestData['negative_id'];
            $sale_detail->negative = $requestData['negative'];
            $sale_detail->save();
        }


        // Attach aceita um array de IDs
        $sale->stores()->attach($requestData['store_id']);

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
    public function edit($id)
    {


        // Obtenha o valor da sessão "store"
        $storeId = session("store");


        // Consulta para obter apenas os produtos associados à loja com ID igual a $storeId
        $sale = Sale::with('saleDetail.productPrice')->whereId($id)->first();

        // Consulta para obter apenas os produtos associados à loja com ID igual a $storeId
        $products = Product::whereHas('stores', function ($query) use ($storeId) {
            $query->where('stores.id', $storeId);
        })->pluck('title', 'id');

        // dd($sale->saleDetail->productPrice);



        return view('promocoes.edit')->with(compact('sale', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSaleRequest $request, $id)
    {
        $requestData = $request->all();

        // Consulta para obter apenas os produtos associados à loja com ID igual a $storeId
        $sale = Sale::with('saleDetail')->whereId($id)->first();

        $sale->update([
            'description' => $requestData['description'],
            'model' => $requestData['model'],
        ]);

        $sale->save();

        $sale_detail = $sale->saleDetail;


        // CASO O MODEL DA PROMOÇÃO SEJA PP, ELE VAI criar uma instância de product_price, criará uma instância de promoção que conterá: ['product', 'price_product', 'description', 'model', 'trigger', 'negative']
        if ($requestData['model']  === "PP") {

            $sale_detail_productPrice = $sale_detail->productPrice;

            $sale_detail_productPrice->product_id = $requestData['product_id'];
            $sale_detail_productPrice->price = $requestData['price_product'];

            $sale_detail_productPrice->save();
        }


        // CASO O MODEL DA PROMOÇÃO SEJA PXLY, ELE SÓ VAI CRIAR UMA INSTÂNCIA DE SALE
        if ($requestData['model']  === "PXLY") {

            $sale_detail->trigger_id = $requestData['trigger_id'];
            $sale_detail->trigger = $requestData['trigger'];

            $sale_detail->negative_id = $requestData['negative_id'];
            $sale_detail->negative = $requestData['negative'];
            $sale_detail->save();
        }

        return redirect()->route('promocoes.index')->with('success', 'Sale created successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sale = Sale::findOrFail($id);

        // Update the product with the validated data
        $sale->delete();

        // Redirect to a view or route after successfully updating the product
        return redirect()->route('promocoes.index')->with('success', 'Sale deleted successfully');
    }
}
