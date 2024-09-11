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

                        <input type="hidden" name="store_id" value="{{ session('store') }}">


                        <div class="mb-4">
                            <label for="model" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                                Modelo:
                            </label>
                            <select name="model" id="model" class="w-full border rounded-md py-2 px-3" required>
                                <!-- <option value="PXLY">Pague X leve Y</option> -->
                                <option value="PP" selected>Preço promocional</option>
                            </select>
                        </div>

                        <div class="mb-4 PP">
                            <label for="product" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                                Produto:
                            </label>
                            <select name="product_id" id="product_id" class="PP_SEL w-full border rounded-md py-2 px-3" required>
                                @foreach ($products as $productId => $productName)
                                    <option value="{{ $productId }}">{{ $productName }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                                Descrição (opcional):
                            </label>
                            <textarea name="description" id="description" class="w-full border rounded-md py-2 px-3" required></textarea>
                        </div>

                        <div class="mb-4 PP">
                            <label for="price_product" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                                Preço do Produto:
                            </label>
                            <input type="number" step="0.01" name="price_product" id="price_product"
                                class="PP_SEL w-full border rounded-md py-2 px-3">
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
