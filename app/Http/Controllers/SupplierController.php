<?php

namespace App\Http\Controllers;

use App\DataTables\SupplierDataTable;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Models\Product;
use App\Models\Store;
use App\Models\Supplier;
use Illuminate\Contracts\Session\Session;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SupplierDataTable $dataTable)
    {
        return $dataTable->render('fornecedores.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $storeId = session("store");

        // Recuperar todos os produtos relacionados à loja atual
        $products = Product::whereHas('stores', function ($query) use ($storeId) {
            $query->where('store_id', $storeId);
        })->get();

        return view('fornecedores.create', compact("products"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSupplierRequest $request)
    {

        $supplier = Supplier::create($request->all());

        // Redirect to a view or route after successfully storing the product
        return redirect()->route('fornecedores.index')->with('success', 'supplier created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $supplier = Supplier::whereId($id)->first();

        // Retorna a view com os dados necessários
        return view('fornecedores.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSupplierRequest $request,$id)
    {
        // Find the product by ID
        $supplier = Supplier::findOrFail($id);

        // Update the product with the validated data
        $supplier->update($request->all());

        // Redirect to a view or route after successfully updating the product
        return redirect()->route('fornecedores.index', $supplier->id)->with('success', 'fornecedor updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);

        // Update the product with the validated data
        $supplier->delete();

        // Redirect to a view or route after successfully updating the product
        return redirect()->route('fornecedores.index')->with('success', 'fornecedor updated successfully');

    }
}
