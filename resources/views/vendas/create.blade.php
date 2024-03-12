@extends('layouts.app')

@section('content')
    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Criar Venda') }}

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
                            CPF ou CNPJ do cliente:
                        </label>
                        <input type="text" name="cpf_cnpj" id="cpf_cnpj" class="w-full border rounded-md py-2 px-3">
                    </div>


                    <div class="mb-4">
                        <label for="store_id" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                            Loja:
                        </label>
                        <select name="store_id" id="store_id" class="w-full border rounded-md py-2 px-3" required>
                            @foreach ($stores as $store)
                                <option value="{{ $store->id }}" {{ $store->id == $userId ? 'selected' : '' }}>
                                    {{ $store->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="product_select" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                            Selecione um Produto:
                        </label>
                        <select name="product_select" id="product_select" class="w-full border rounded-md py-2 px-3"
                            onchange="addProductField()">
                            <option value="" disabled selected>Escolha um produto</option>
                            @foreach ($products as $productId => $productName)
                                <option value="{{ $productId }}">{{ $productName }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div id="productsContainer">
                        <table
                            class="w-full border border-collapse rounded-md text-gray-700 dark:text-gray-300 font-bold mb-2 divide-y divide-gray-200"
                            style="border-radius: none">
                            <thead>
                                <tr>
                                    <th class="border p-2 text-center">ID</th>
                                    <th class="border p-2 text-center">Produto</th>
                                    <th class="border p-2 text-center">Quantidade</th>
                                    <th class="border p-2 text-center">Preço unitário</th>
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
                        <span id="total_price" class="text-gray-700 dark:text-gray-300 font-bold text-2xl mb-2">0.00</span>
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
        const addedProducts = [];

        const promotions = @json($promotions);



        function addProductField() {
            const productId = document.getElementById('product_select').value;
            const productName = document.getElementById('product_select').options[document.getElementById('product_select')
                .selectedIndex].text;
            const quantity = prompt(`Digite a quantidade para o Produto ${productName}:`);

            if (quantity !== null && quantity.trim() !== '') {
                // Verificar se o produto já está na lista
                const existingProductIndex = addedProducts.findIndex(product => product.id === productId);

                if (existingProductIndex !== -1) {
                    // Se o produto já estiver na lista, atualize a quantidade
                    addedProducts[existingProductIndex].quantity = parseInt(addedProducts[existingProductIndex].quantity) +
                        parseInt(quantity);
                    updateTableRow(existingProductIndex, addedProducts[existingProductIndex].quantity);
                    updateTotalPrice(); // Adicione esta função para calcular e exibir o preço total
                    // console.log(addedProducts);
                } else {
                    // Caso contrário, adicione uma nova linha
                    fetch(`http://localhost:8989/api/priceproduct/${productId}`)
                        .then(response => response.json())
                        .then(data => {
                            const tableBody = document.getElementById('productTableBody');
                            const newRow = tableBody.insertRow();
                            newRow.innerHTML = `
                                <td class="border p-4 text-center">${productId}</td>
                                <td class="border p-4 text-center">${productName}</td>
                                <td class="border p-4 text-center">${quantity}</td>
                                <td class="border p-4 text-center">${formatCurrency(data.price)}</td>
                            `;

                            // Adicione as informações do produto ao array
                            addedProducts.push({
                                id: productId,
                                quantity: quantity,
                            });

                            updateTotalPrice(); // Adicione esta função para calcular e exibir o preço total
                            // console.log(addedProducts);
                            document.getElementById('products_data').value = JSON.stringify(addedProducts);
                        })
                        .catch(error => {
                            console.error('Erro ao obter preço do produto:', error);
                        });
                }
            }
        }

        function updateTableRow(index, newQuantity) {
            // Atualizar a linha na tabela com a nova quantidade
            const tableBody = document.getElementById('productTableBody');
            const row = tableBody.rows[index];
            row.cells[2].innerText = newQuantity;
        }

        function updateTotalPrice() {
            const rows = document.getElementById('productTableBody').getElementsByTagName('tr');
            let totalPrice = 0;

            for (const row of rows) {
                const productId = row.cells[0].innerText;
                let quantity = parseFloat(row.cells[2].innerText);
                const price = parseFloat(row.cells[3].innerText.replace(/[^\d.,]/g, '').replace(',', '.'));

                for (const promotion of promotions) {
                    const {
                        trigger_id,
                        negative_id,
                        trigger,
                        negative
                    } = promotion.sale_detail;

                    if ((productId == trigger_id || productId == negative_id) &&
                        (trigger_id == negative_id ? (quantity >= trigger && quantity - trigger > 0) : (negative_id ==
                            productId))) {

                        if (trigger_id == negative_id) {
                            const _quantity = quantity / negative;
                            quantity -= Math.floor(_quantity * (negative - trigger));
                        } else {
                            const negative_diminutor = addedProducts.find(objeto => objeto.id == trigger_id);

                            if (negative_diminutor && negative_diminutor.quantity >= trigger) {
                                const numeroPromos = Math.floor(negative_diminutor.quantity / trigger);
                                quantity -= numeroPromos * negative;
                            }
                        }
                    }
                }

                console.log(quantity + "   " + price);
                quantity > -1 && (totalPrice += quantity * price);
            }

            // Atualizar o campo de valor total no formulário
            document.getElementById('total_price').innerText = formatCurrency(totalPrice);
            document.getElementById('_total_price').value = JSON.stringify(totalPrice);
        }


        function formatCurrency(value) {
            return new Intl.NumberFormat('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            }).format(value);
        }

        // Adicione esta função para preparar os dados antes do envio do formulário
        function prepareAndSubmit() {
            alert("here");
            // Adicione o array de produtos ao formulário
            document.getElementById('products_data').value = JSON.stringify(addedProducts);
            return true; // Continue com a submissão normal do formulário
        }
    </script>
@endsection
