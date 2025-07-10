<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Cadastrar Novo Produto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- O action do formulário agora aponta para a rota de 'store' --}}
                    <form method="POST" action="{{ route('produtos.store') }}">
                        @csrf

                        <div>
                            <label for="categoria_id">Categoria</label>
                            <select id="categoria_id" name="categoria_id" class="block mt-1 w-full">
                                <option value="">Selecione uma categoria</option>
                                {{-- Loop para exibir as categorias que vieram do Controller --}}
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <label for="nome">Nome do Produto</label>
                            <input id="nome" class="block mt-1 w-full" type="text" name="nome" required autofocus />
                        </div>

                        <div class="mt-4">
                            <label for="descricao">Descrição</label>
                            <textarea id="descricao" name="descricao" class="block mt-1 w-full"></textarea>
                        </div>

                        <div class="mt-4">
                            <label for="marca">Marca</label>
                            <input id="marca" class="block mt-1 w-full" type="text" name="marca" />
                        </div>

                        <div class="flex items-center justify-end mt-6 pt-6 border-t border-gray-200">
                            <x-back-button :href="route('produtos.index')" />
                            <div class="ms-3">
                                <x-action-button type="button" color="green">
                                    <i class="fas fa-add mr-2"></i>
                                    Cadastrar Produto
                                </x-action-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
