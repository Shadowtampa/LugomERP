@extends('layouts.app')

@section('content')
    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Visualizar Venda') }}

                {{-- {{dd($promotions)}} --}}
            </h2>
        </div>
    </header>
    <div class="container mx-auto mt-8">
        <div class="max-w-md mx-auto bg-white dark:bg-gray-800 rounded-md overflow-hidden shadow-md">
            <div class="p-6">
                <form action="{{ route('apivenda.store') }}" method="POST">
                    @csrf

                    <input type="hidden" name="products_data" id="products_data">
                    <input type="hidden" name="_total_price" id="_total_price">


                    <div class="mb-4">
                        <label for="cpf_cnpj" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                            Cliente: {{ isset($client) ? $client->name : 'Venda avulsa' }}

                        </label>
                        <label for="cpf_cnpj" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                        </label>
                    </div>


                    <div class="mb-4">
                        <label for="store_id" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                            Loja: {{ $store_title }}
                        </label>
                    </div>

                    <div id="productsContainer">
                        <table
                            class="w-full border border-collapse rounded-md text-gray-700 dark:text-gray-300 font-bold mb-2 divide-y divide-gray-200"
                            style="border-radius: none">
                            <thead>
                                <tr>
                                    <th class="border p-2 text-center">Produto</th>
                                    <th class="border p-2 text-center">Quantidade</th>
                                </tr>
                            </thead>
                            <tbody id="productTableBody" class="bg-white divide-y divide-gray-200">
                                <!-- Aqui serão adicionadas as linhas da tabela dinamicamente -->
                            </tbody>
                        </table>
                    </div>

                    <div class="mb-4 flex items-center justify-center">
                        <label for="total_price" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                            Valor Total:
                        </label>
                        <span id="total_price"
                            class="text-gray-700 dark:text-gray-300 font-bold text-2xl mb-2">{{ $venda->final_price }}</span>
                    </div>


                </form>
            </div>
        </div>
    </div>

    <script>
        const addedProducts = [];

        const products = @json($products);

        function formatCurrency(value) {
            return new Intl.NumberFormat('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            }).format(value);
        }
        // Adiciona uma nova linha à tabela usando os dados de products
        function addRowFromProduct(product) {

            console.log(product[0])
            const tableBody = document.getElementById('productTableBody');
            const newRow = tableBody.insertRow();
            newRow.innerHTML = `
        <td class="border p-4 text-center">${product[0]}</td>
        <td class="border p-4 text-center">${product[1]}</td>
    `;
        }

        function updateTotalPrice(totalPrice) {
            document.getElementById('total_price').innerText = formatCurrency(totalPrice);
        }

        // Chama a função no carregamento da página
        window.onload = function() {

            // Adiciona uma nova linha para cada produto em products
            products.forEach(product => {
                addRowFromProduct(product);
            });

            // Obtenha o valor total (supondo que esteja disponível no back-end)
            const totalPrice = parseFloat({{ $venda->final_price ?? 0 }});

            // Atualiza o valor total na inicialização
            updateTotalPrice(totalPrice);
        };
    </script>
@endsection
