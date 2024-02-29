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
                    <form action="{{ route('apisale.update', $sale->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="model" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                                Modelo:
                            </label>
                            <select name="model" id="model" class="w-full border rounded-md py-2 px-3" required>
                                <option value="PXLY" {{ $sale->model === 'PXLY' ? 'selected' : '' }}>Pague X leve Y</option>
                                <option value="PP" {{ $sale->model === 'PP' ? 'selected' : '' }}>Preço promocional</option>
                            </select>
                        </div>


                        <div class="mb-4 PP">
                            <label for="product" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                                Produto:
                            </label>
                            <select name="product_id" id="product_id" class="PP_SEL w-full border rounded-md py-2 px-3" required>
                                @foreach ($products as $productId => $productName)
                                <option value="{{ $productId }}" @if ($productId == $sale->saleDetail->productPrice->product_id) selected @endif>{{ $productName }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4 PXLY">
                            <label for="trigger" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                                Trigger:
                            </label>
                            <select name="trigger_id" id="trigger_id" class="PXLY_SEL w-full border rounded-md py-2 px-3" required>
                                @foreach ($products as $triggerId => $triggerName)
                                <option value="{{ $triggerId }}" @if ($triggerId == $sale->saleDetail->trigger_id) selected @endif>{{ $triggerName }}</option>

                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4 PXLY">
                            <label for="trigger" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                                Gatilho:
                            </label>
                            <input type="number" name="trigger" id="trigger" class="PXLY_SEL w-full border rounded-md py-2 px-3"
                            value={{$sale->saleDetail->trigger}}>
                        </div>

                        <div class="mb-4 PXLY">
                            <label for="negative" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                                Negative:
                            </label>
                            <select name="negative_id" id="negative_id" class="PXLY_SEL w-full border rounded-md py-2 px-3" required>
                                @foreach ($products as $negativeId => $negativeName)
                                <option value="{{ $negativeId }}" @if ($negativeId == $sale->saleDetail->negative_id) selected @endif>{{ $negativeName }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4 PXLY">
                            <label for="negative" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                                Negativo:
                            </label>
                            <input type="number " name="negative" id="negative" class="PXLY_SEL w-full border rounded-md py-2 px-3"
                            value={{$sale->saleDetail->negative}}>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                                Descrição:
                            </label>
                            <textarea 
                                name="description" 
                                id="description" 
                                class="w-full border rounded-md py-2 px-3" 
                                required
                                >{{ $sale->description }}</textarea>
                        </div>

                        <div class="mb-4 PP">
                            <label for="price_product" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                                Preço do Produto:
                            </label>
                            <input type="number" step="0.01" name="price_product" id="price_product"
                                class="PP_SEL w-full border rounded-md py-2 px-3" value= {{$sale->saleDetail->productPrice->price}}>
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

        @push('scripts')
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function() {

                    // Esconde os campos irrelevantes com base no valor inicial de 'model'
                    if ($('#model').val() === 'PP') {
                        $('.PP').show();
                        $('.PXLY').hide();

                        $('.PP_SEL').prop('required', true);
                        $('.PXLY_SEL').prop('required', false);

                    } else if ($('#model').val() === 'PXLY') {
                        $('.PP').hide();
                        $('.PXLY').show();

                        $('.PP_SEL').prop('required', false);
                        $('.PXLY_SEL').prop('required', true);
                    }


                    // Monitora a mudança no modelo
                    $('#model').change(function() {
                        // Mostra os campos correspondentes ao modelo selecionado
                        if ($(this).val() === 'PP') {
                            $('.PP').show();
                            $('.PXLY').hide();

                            $('.PP_SEL').prop('required', true);
                            $('.PXLY_SEL').prop('required', false);

                        } else if ($(this).val() === 'PXLY') {
                            $('.PP').hide();
                            $('.PXLY').show();
                            
                            $('.PP_SEL').prop('required', false);
                            $('.PXLY_SEL').prop('required', true);


                        }
                    });
                });
            </script>
        @endpush
    @endsection
