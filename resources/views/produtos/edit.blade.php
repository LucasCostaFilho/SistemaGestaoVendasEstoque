<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Editar Produto: ') }} {{ $produto->nome }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('produtos.update', $produto) }}">
                        @csrf
                        @method('PUT')
                        <div class="mt-4">
                            <label for="categoria_id" class="block font-medium text-sm text-gray-700">Categoria</label>
                            <select id="categoria_id" name="categoria_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">Selecione uma categoria</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" @selected(old('categoria_id', $produto->categoria_id) == $categoria->id)>
                                        {{ $categoria->nome }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <label for="nome" class="block font-medium text-sm text-gray-700">Nome do Produto</label>
                            <input id="nome" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text" name="nome" value="{{ old('nome', $produto->nome) }}" required autofocus />
                        </div>
                        <div class="mt-4">
                            <label for="descricao" class="block font-medium text-sm text-gray-700">Descrição</label>
                            <textarea id="descricao" name="descricao" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('descricao', $produto->descricao) }}</textarea>
                        </div>
                        <div class="mt-4">
                            <label for="marca" class="block font-medium text-sm text-gray-700">Marca</label>
                            <input id="marca" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text" name="marca" value="{{ old('marca', $produto->marca) }}" />
                        </div>
                        <div class="flex items-center justify-end mt-6">
                            <x-back-button :href="route('produtos.index')" />
                            <div class="ms-3">
                                <x-action-button type="button" color="green">
                                    <i class="fas fa-check mr-2"></i>
                                    Salvar Alterações
                                </x-action-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
