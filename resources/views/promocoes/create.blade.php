@extends('layouts.app')

@section('content')
    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Promoções') }}
            </h2>
        </div>
    </header>
    <div class="container mx-auto mt-8">
        <div class="max-w-md mx-auto bg-white dark:bg-gray-800 rounded-md overflow-hidden shadow-md">
            <div class="p-6">
                <form action="{{ route('apisale.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="product" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                            Produto:
                        </label>
                        <input type="text" name="product" id="product" class="w-full border rounded-md py-2 px-3"
                            required>
                    </div>

                    <div class="mb-4">
                        <label for="price_product" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                            Preço do Produto:
                        </label>
                        <input type="text" name="price_product" id="price_product" class="w-full border rounded-md py-2 px-3"
                            required>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                            Descrição:
                        </label>
                        <textarea name="description" id="description" class="w-full border rounded-md py-2 px-3" required></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="model" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                            Modelo:
                        </label>
                        <input type="text" name="model" id="model" class="w-full border rounded-md py-2 px-3"
                            required>
                    </div>

                    <div class="mb-4">
                        <label for="trigger" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                            Gatilho:
                        </label>
                        <input type="text" name="trigger" id="trigger" class="w-full border rounded-md py-2 px-3"
                            required>
                    </div>

                    <div class="mb-4">
                        <label for="negative" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                            Negativo:
                        </label>
                        <input type="text" name="negative" id="negative" class="w-full border rounded-md py-2 px-3"
                            required>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md">
                            Criar Venda
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
