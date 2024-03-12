@extends('layouts.app')

@section('content')
    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Criar Venda') }}
            </h2>
        </div>
    </header>
    <div class="container mx-auto mt-8">
        <div class="max-w-md mx-auto bg-white dark:bg-gray-800 rounded-md overflow-hidden shadow-md">
            <div class="p-6">
                <form action="{{ route('apivenda.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="store_id" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                            Loja:
                        </label>
                        <select name="store_id" id="store_id" class="w-full border rounded-md py-2 px-3" required>
                            @foreach($stores as $store)
                                <option value="{{ $store->id }}" {{ $store->id == $selected_store ? 'selected' : '' }}>
                                    {{ $store->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label for="product_select" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                            Selecione um Produto:
                        </label>
                        <select name="product_select" id="product_select" class="w-full border rounded-md py-2 px-3" onchange="addProductField()">
                            <option value="" disabled selected>Escolha um produto</option>
                            @foreach($products as $productId => $productName)
                                <option value="{{ $productId }}">{{ $productName }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div id="productsContainer">
                        <table class="w-full border border-collapse">
                            <thead>
                                <tr>
                                    <th class="border">ID</th>
                                    <th class="border">Produto</th>
                                    <th class="border">Quantidade</th>
                                </tr>
                            </thead>
                            <tbody id="productTableBody">
                                <!-- Aqui serão adicionadas as linhas da tabela dinamicamente -->
                            </tbody>
                        </table>
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

    <script>
        function addProductField() {
            const productId = document.getElementById('product_select').value;
            const productName = document.getElementById('product_select').options[document.getElementById('product_select').selectedIndex].text;
            const quantity = prompt(`Digite a quantidade para o Produto ${productName}:`);

            if (quantity !== null && quantity.trim() !== '') {
                const tableBody = document.getElementById('productTableBody');
                const newRow = tableBody.insertRow();
                newRow.innerHTML = `
                    <td class="border">${productId}</td>
                    <td class="border">${productName}</td>
                    <td class="border">${quantity}</td>
                `;
            }
        }
    </script>
@endsection

