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
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        //
    }
}
