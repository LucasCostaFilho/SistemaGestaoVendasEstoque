<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Cadastrar Nova Categoria') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('categorias.store') }}">
                        @csrf

                        <div>
                            <label for="nome">Nome da Categoria</label>
                            <input id="nome" class="block mt-1 w-full" type="text" name="nome" required autofocus />
                        </div>

                        <div class="mt-4">
                            <label for="descricao">Descrição</label>
                            <textarea id="descricao" name="descricao" class="block mt-1 w-full"></textarea>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-back-button :href="route('categorias.index')" />

                            <div class="ms-3">
                                <x-action-button type="button" color="green">
                                    <i class="fas fa-check mr-2"></i>
                                    Cadastrar Categoria
                                </x-action-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
