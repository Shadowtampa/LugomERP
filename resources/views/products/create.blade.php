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
                <form action="{{ route('produto.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="title" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                            Título:
                        </label>
                        <input type="text" name="title" id="title" class="w-full border rounded-md py-2 px-3"
                            required>
                    </div>

                    <div class="mb-4">
                        <label for="image_url" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                            URL da Imagem:
                        </label>
                        <input type="text" name="image_url" id="image_url" class="w-full border rounded-md py-2 px-3"
                            required>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                            Descrição:
                        </label>
                        <textarea name="description" id="description" class="w-full border rounded-md py-2 px-3" required></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="category" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                            Categoria:
                        </label>
                        <input type="text" name="category" id="category" class="w-full border rounded-md py-2 px-3"
                            required>
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
