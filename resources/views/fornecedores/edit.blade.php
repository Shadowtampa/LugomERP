@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-8">
        <div class="max-w-md mx-auto bg-white dark:bg-gray-800 rounded-md overflow-hidden shadow-md">
            <div class="p-6">
                <form action="{{ route('apisupplier.update', $supplier->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                            Nome:
                        </label>
                        <input type="text" name="name" id="name" class="w-full border rounded-md py-2 px-3" value="{{ $supplier->name }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="cnpj_cpf" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                            CNPJ/CPF:
                        </label>
                        <input type="text" name="cnpj_cpf" id="cnpj_cpf" class="w-full border rounded-md py-2 px-3" value="{{ $supplier->cnpj_cpf }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="address" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                            Endereço:
                        </label>
                        <input type="text" name="address" id="address" class="w-full border rounded-md py-2 px-3" value="{{ $supplier->address }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="phone" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                            Telefone:
                        </label>
                        <input type="text" name="phone" id="phone" class="w-full border rounded-md py-2 px-3" value="{{ $supplier->phone }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                            E-mail:
                        </label>
                        <input type="email" name="email" id="email" class="w-full border rounded-md py-2 px-3" value="{{ $supplier->email }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="site" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                            Site:
                        </label>
                        <input type="text" name="site" id="site" class="w-full border rounded-md py-2 px-3" value="{{ $supplier->site }}">
                    </div>

                    <div class="mb-4">
                        <label for="responsibility" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                            Responsabilidade:
                        </label>
                        <input type="text" name="responsibility" id="responsibility" class="w-full border rounded-md py-2 px-3" value="{{ $supplier->responsibility }}" required>
                    </div>
                    
                    <div class="mt-4">
                        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md">
                            Atualizar Fornecedor
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
