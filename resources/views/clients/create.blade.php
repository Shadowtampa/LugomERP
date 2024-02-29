@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-8">
        <div class="max-w-md mx-auto bg-white dark:bg-gray-800 rounded-md overflow-hidden shadow-md">
            <div class="p-6">
                <form action="{{ route('apiclients.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                            Nome:
                        </label>
                        <input type="text" name="name" id="name" class="w-full border rounded-md py-2 px-3" required>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                            E-mail:
                        </label>
                        <input type="email" name="email" id="email" class="w-full border rounded-md py-2 px-3" required>
                    </div>

                    <div class="mb-4">
                        <label for="phone" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                            Telefone:
                        </label>
                        <input type="text" name="phone" id="phone" class="w-full border rounded-md py-2 px-3" required>
                    </div>

                    <div class="mb-4">
                        <label for="address" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                            Endereço:
                        </label>
                        <input type="text" name="address" id="address" class="w-full border rounded-md py-2 px-3" required>
                    </div>

                    <div class="mb-4">
                        <label for="cpf_cnpj" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                            CPF ou CNPJ:
                        </label>
                        <input type="text" name="cpf_cnpj" id="cpf_cnpj" class="w-full border rounded-md py-2 px-3" required>
                    </div>

                    <div class="mb-4">
                        <label for="birthdate" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                            Data de Nascimento:
                        </label>
                        <input type="date" name="birthdate" id="birthdate" class="w-full border rounded-md py-2 px-3" required>
                    </div>

                    <div class="mb-4">
                        <label for="gender" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                            Gênero:
                        </label>
                        <select name="gender" id="gender" class="w-full border rounded-md py-2 px-3" required>
                            <option value="male">Masculino</option>
                            <option value="female">Feminino</option>
                            <option value="other">Outro</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="status" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                            Status:
                        </label>
                        <select name="status" id="status" class="w-full border rounded-md py-2 px-3" required>
                            <option value="active">Ativo</option>
                            <option value="inactive">Inativo</option>
                            <!-- Adicione outras opções de status conforme necessário -->
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="stores" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                            Lojas:
                        </label>
                        <select name="stores[]" id="stores" multiple class="w-full border rounded-md py-2 px-3" required>
                            @foreach($stores as $store)
                                <option value="{{ $store->id }}">{{ $store->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mt-4">
                        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md">
                            Criar Cliente
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
