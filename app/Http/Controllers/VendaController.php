<?php

namespace App\Http\Controllers;

use App\DataTables\VendaDataTable;
use App\Http\Requests\StoreVendaRequest;
use App\Http\Requests\UpdateVendaRequest;
use App\Models\Client;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Store;
use App\Models\User;
use App\Models\Venda;

class VendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(VendaDataTable $dataTable)
    {
        return $dataTable->render('vendas.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        // Obtém o ID do usuário da sessão
        $userId = auth()->id();

        $storeId = session("store");
        $stores = User::find($userId)->stores;

        // Consulta para obter todas as promoções cujo model é igual a 'PXLY'
        $promotions = User::find($userId)->sales()->where('model', 'PXLY');
        $promotions->load('saleDetail');


        // Consulta para obter apenas os produtos associados à loja com ID igual a $storeId
        $products = Product::whereHas('stores', function ($query) use ($storeId) {
            $query->where('stores.id', $storeId);
        })->pluck('title', 'id');

        return view('vendas.create', compact('userId', 'stores', 'products', 'promotions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVendaRequest $request)
    {


        $requestData = $request->all();

        // Convertendo a string JSON em array
        $productsData = json_decode($requestData['products_data'], true);

        $client = Client::where('cpf_cnpj', $requestData['cpf_cnpj'])->first();

        // 'store_id', 'client_id', 'final_price', 'payment_method', 'status', 'delivery_address'


        // Cria o modelo ProductPrice com os dados do request
        $venda = Venda::create([
            'store_id' => intval($requestData['store_id'] ?? null),
            'client_id' => $client,
            'final_price' => $requestData['_total_price'],
            'payment_method' => $requestData['payment_method'] ?? null,
            'status' => $requestData['status'] ?? "finalizado",
            'delivery_address' => $requestData['delivery_address'] ?? null,
        ]);

        // Adicionando os produtos à venda com attach
        foreach ($productsData as $productData) {
            $venda->products()->attach($productData['id'], ['quantity' => $productData['quantity']]);
        }


        // Redirect to a view or route after successfully storing the product
        return redirect()->route('vendas.index')->with('success', 'Venda created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {



        // Obtém o ID do usuário da sessão
        $userId = auth()->id();

        $venda = Venda::whereId($id)->first();

        $store_title = $venda->store->title;

        $client = $venda->client;

        $products = $venda->products->map(function ($product) {
            $quantity = $product->pivot->quantity;
            return [$product->title,$quantity];
        });

        return view('vendas.show', compact('venda', 'userId', 'products', 'client', 'store_title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venda $venda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVendaRequest $request, Venda $venda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venda $venda)
    {
        //
    }
}
