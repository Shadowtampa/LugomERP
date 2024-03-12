<?php

namespace App\Http\Controllers;

use App\DataTables\ClientDataTable;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use App\Models\Store;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ClientDataTable $dataTable)
    {
        return $dataTable->render('clients.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $stores = Store::all();

        return view('clients.create', compact('stores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request)
    {

        $client = Client::create($request->all());

        $client->stores()->attach($request->input('stores'));

        // Redirect to a view or route after successfully storing the product
        return redirect()->route('clientes.index')->with('success', 'Client created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $client = Client::whereId($id)->first();

        $stores = Store::all();
        // Retorna a view com os dados necessários
        return view('clients.edit', compact('client', 'stores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, $id)
    {
        // Find the product by ID
        $client = Client::findOrFail($id);

        // Update the product with the validated data
        $client->update($request->all());

        // Redirect to a view or route after successfully updating the product
        return redirect()->route('clientes.index', $client->id)->with('success', 'cliente updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cliente = Client::findOrFail($id);

        // Update the product with the validated data
        $cliente->delete();

        // Redirect to a view or route after successfully updating the product
        return redirect()->route('clientes.index')->with('success', 'Client updated successfully');

    }
}
