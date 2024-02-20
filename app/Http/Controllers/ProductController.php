<?php

namespace App\Http\Controllers;

use App\DataTables\ProductDataTable;
use App\DataTables\ProductPriceDataTable;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\ProductPrice;
use DataTables;
use Yajra\DataTables\Html\Builder;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('produtos.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        // Create a new Product instance with the validated data
        $product = Product::create($request->all());

        // Redirect to a view or route after successfully storing the product
        return redirect()->route('produtos.index')->with('success', 'Product created successfully');
    }
    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

 
     public function edit($id, Builder $builder)
     {
         if (request()->ajax()) {
             $query = ProductPrice::query()->where('product_id', $id);
     
             return DataTables::of($query)
                 ->addColumn('isSale', function ($productPrice) {
                     return $productPrice->isSale() ? 'Verdadeiro' : 'Falso';
                 })
                 ->addColumn('edit', function ($productPrice) {
                     return '<a href="' . route('productprices.edit', $productPrice->id) . '" class="btn btn-warning btn-sm">Editar</a>';
                 })
                 ->addColumn('delete', function ($productPrice) {
                     return '<form action="' . route('priceproduct.destroy', $productPrice->id) . '" method="POST" style="display:inline">' .
                         csrf_field() .
                         method_field('DELETE') .
                         '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Excluir o produto: ' . $productPrice->title . ' ?\')">Deletar</button>' .
                         '</form>';
                 })
                 ->rawColumns(['edit', 'delete'])
                 ->toJson();
         }
     
         $product = Product::findOrFail($id);
     
         $html = $builder
             ->columns([
                 ['data' => 'id', 'name' => 'id', 'title' => 'ID'],
                 ['data' => 'price', 'name' => 'price', 'title' => 'Preço'],
                 ['data' => 'isSale', 'name' => 'isSale', 'title' => 'Está em promoção'],
                 ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Criado em'],
                 ['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Atualizado em'],
                 ['data' => 'edit', 'name' => 'edit', 'title' => 'Editar', 'orderable' => false, 'searchable' => false],
                 ['data' => 'delete', 'name' => 'delete', 'title' => 'Deletar', 'orderable' => false, 'searchable' => false],
             ])
             ->parameters([
                 'buttons' => ['export', 'add'],
             ]);
     
         // Retorna a view com os dados necessários
         return view('produtos.edit', compact('product', 'html'));
     }
     

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, $id)
    {
        // Find the product by ID
        $product = Product::findOrFail($id);

        // Update the product with the validated data
        $product->update($request->all());

        // Redirect to a view or route after successfully updating the product
        return redirect()->route('produtos.index', $product->id)->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Update the product with the validated data
        $product->delete();

        // Redirect to a view or route after successfully updating the product
        return redirect()->route('produtos.index')->with('success', 'Product updated successfully');

    }
}
