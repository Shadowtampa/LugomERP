@extends('layouts.app')

@section('content')
    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Editar Promoção') }}
            </h2>
        </div>
    </header>
    <div class="container mx-auto mt-8">
        <div class="max-w-md mx-auto bg-white dark:bg-gray-800 rounded-md shadow-md">
            <div class="p-6">
                <form action="{{ route('produto.update', $sale->id) }}" method="POST">
                    @csrf
                    @method('PUT')



                <div class="mt-4">
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md">
                        Atualizar Produto
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection