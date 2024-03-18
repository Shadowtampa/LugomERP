@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-8">
        <div class="max-w-md mx-auto bg-white dark:bg-gray-800 rounded-md overflow-hidden shadow-md">
            <div class="p-6">
                <form action="{{ route('apistore.update', $store->id) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- Adiciona um campo hidden para indicar o método PUT -->

                    <div class="mb-4">
                        <label for="official_name" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                            Nome da Loja:
                        </label>
                        <input type="text" name="official_name" id="official_name" class="w-full border rounded-md py-2 px-3" value="{{ $store->official_name }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="alias" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                            Pseudônimo (Alias) da Loja:
                        </label>
                        <input type="text" name="alias" id="alias" class="w-full border rounded-md py-2 px-3" value="{{ $store->alias }}">
                    </div>

                    <div class="mb-4">
                        <label for="address" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                            Endereço:
                        </label>
                        <input type="text" name="address" id="address" class="w-full border rounded-md py-2 px-3" value="{{ $store->address }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                            Descrição:
                        </label>
                        <textarea name="description" id="description" class="w-full border rounded-md py-2 px-3" required>{{ $store->description }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="contact" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                            Contato:
                        </label>
                        <input type="text" name="contact" id="contact" class="w-full border rounded-md py-2 px-3" value="{{ $store->contact }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="owner" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                            Proprietário:
                        </label>
                        <input type="text" name="owner" id="owner" class="w-full border rounded-md py-2 px-3" value="{{ $store->owner }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="location" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                            Localização:
                        </label>
                        <input type="text" name="location" id="location" class="w-full border rounded-md py-2 px-3" value="{{ $store->location }}">
                    </div>
                    
                    <div class="mt-4">
                        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md">
                            Atualizar Loja
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
