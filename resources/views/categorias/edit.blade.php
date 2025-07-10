<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Editar Categoria: ') }} {{ $categoria->nome }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('categorias.update', $categoria) }}">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="nome">Nome da Categoria</label>
                            <input id="nome" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text" name="nome" value="{{ old('nome', $categoria->nome) }}" required autofocus />
                        </div>

                        <div class="mt-4">
                            <label for="descricao">Descrição</label>
                            <textarea id="descricao" name="descricao" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('descricao', $categoria->descricao ?? '') }}</textarea>
                        </div>
                            <div class="flex items-center justify-end mt-4">
                                <x-back-button :href="route('categorias.index')" />

                                <div class="ms-3">
                                    <x-action-button type="button" color="green">
                                        <i class="fas fa-save mr-2"></i>
                                        Salvar Alterações
                                    </x-action-button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
