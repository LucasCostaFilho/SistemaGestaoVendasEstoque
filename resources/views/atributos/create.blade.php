<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastrar Novo Atributo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    {{-- Exibir erros de validação, se houver --}}
                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg" role="alert">
                            <p class="font-bold">Opa! Algo deu errado:</p>
                            <ul class="mt-2 list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('atributos.store') }}">
                        @csrf

                        {{-- CAMPO NOME DO ATRIBUTO --}}
                        <div>
                            <label for="nome" class="block font-medium text-sm text-gray-700">Nome do Atributo</label>
                            <input id="nome" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text" name="nome" value="{{ old('nome') }}" required autofocus placeholder="Ex: Cor, Tamanho, Voltagem" />
                        </div>

                        {{-- BOTÕES DE AÇÃO --}}
                        <div class="flex items-center justify-end mt-6 pt-6 border-t border-gray-200">
                            <x-back-button :href="route('atributos.index')" />
                            <div class="ms-3">
                                <x-action-button type="submit" color="green">
                                    <i class="fas fa-check mr-2"></i>
                                    Cadastrar Atributo
                                </x-action-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>