<?php

namespace App\Http\Controllers;

use App\DataTables\StoreDataTable;
use App\Http\Requests\StoreStoreRequest;
use App\Http\Requests\UpdateStoreRequest;
use App\Models\Store;
use Illuminate\Contracts\Session\Session;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(StoreDataTable $dataTable)
    {
        return $dataTable->render('lojas.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lojas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStoreRequest $request)
    {
        $store = Store::create($request->all());

        // Redirect to a view or route after successfully storing the product
        return redirect()->route('lojas.index')->with('success', 'Client created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Store $store)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $store = Store::whereId($id)->first();
        // Retorna a view com os dados necessários
        return view('lojas.edit', compact('store'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStoreRequest $request, $id)
    {
        // Find the product by ID
        $store = Store::findOrFail($id);

        // Update the product with the validated data
        $store->update($request->all());

        // Redirect to a view or route after successfully updating the product
        return redirect()->route('lojas.index', $store->id)->with('success', 'store updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $store = Store::findOrFail($id);

        // Update the product with the validated data
        $store->delete();

        // Redirect to a view or route after successfully updating the product
        return redirect()->route('lojas.index')->with('success', 'Store updated successfully');
    }

    public function sethome($id)
    {
        // Update the product with the validated data
        session()->put('store', $id);

        // Redirect to a view or route after successfully updating the product
        return redirect()->route('lojas.index')->with('success', 'Store updated successfully');
    }
}
