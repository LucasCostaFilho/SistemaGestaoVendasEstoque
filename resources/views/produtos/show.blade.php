<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalhes do Produto: {{ $produto->nome }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="mb-4">
                        <h3 class="text-lg font-bold">{{ $produto->nome }}</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="font-semibold">Marca:</p>
                            <p>{{ $produto->marca ?? 'Não informada' }}</p>
                        </div>
                        <div>
                            <p class="font-semibold">Categoria:</p>
                            <p>{{ $produto->categoria->nome ?? 'Sem Categoria' }}</p>
                        </div>
                    </div>

                    <div class="mt-4">
                        <p class="font-semibold">Descrição:</p>
                        <p>{{ $produto->descricao ?? 'Sem descrição.' }}</p>
                    </div>

                    <div class="text-sm text-gray-500 mt-6 border-t pt-4">
                        <p><strong>Cadastrado em:</strong> {{ $produto->created_at->format('d/m/Y H:i') }}</p>
                        <p><strong>Última Atualização:</strong> {{ $produto->updated_at->format('d/m/Y H:i') }}</p>
                    </div>

                    {{-- Botões de Ação --}}
                    <div class="flex items-center justify-end mt-6">
                        <x-back-button :href="route('produtos.index')"/>
                        <x-action-button color="yellow" :href="route('produtos.edit', $produto)">
                            <i class="fas fa-pencil-alt mr-2"></i>
                            Editar
                        </x-action-button>
                        <form method="POST" action="#" onsubmit="return confirm('Tem certeza que deseja deletar este produto?');">
                            @csrf
                            @method('DELETE')
                            <x-action-button type="button" color="red" title="Deletar Produto">
                                <i class="fas fa-trash-alt mr-2"></i>
                                Excluir
                            </x-action-button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
