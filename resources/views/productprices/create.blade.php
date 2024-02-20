@extends('layouts.app')

@section('content')
    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Produtos') }}
            </h2>
        </div>
    </header>
    <div class="container mx-auto mt-8">
        <div class="max-w-md mx-auto bg-white dark:bg-gray-800 rounded-md overflow-hidden shadow-md">
            <div class="p-6">
                <form action="{{ route('priceproduct.store') }}" method="POST">
                    @csrf

                    <input type="hidden" name="page_id" value="{{ str_replace('produtos', '', request()->segment(2)) }}">

                    <div class="mb-4">
                        <label for="price" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                            Preço:
                        </label>
                        <input type="text" name="price" id="price" class="w-full border rounded-md py-2 px-3"
                            pattern="^\d+(\.\d{1,2})?$" title="Informe um valor em dinheiro válido (ex: 123.45)" required>
                        <small class="text-gray-500">Informe um valor em dinheiro válido (ex: 123.45)</small>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md">
                            Criar Produto
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
