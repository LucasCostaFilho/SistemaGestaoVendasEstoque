<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Lista de Produtos') }}
            </h2>
            <div class="flex space-x-4">
                <a href="{{ route('categorias.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md text-sm">
                    Gerenciar Categorias
                </a>
                <x-action-button type="button" color="green">
                    <i class="fas fa-check mr-2"></i>
                    Cadastrar Produto
                </x-action-button>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Marca</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($produtos as $produto)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $produto->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $produto->nome }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $produto->marca ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{-- Links para editar/deletar podem ser adicionados aqui --}}
                                        <x-action-button color="blue" :href="route('produtos.show', $produto)" title="Ver Detalhes">
                                            <i class="fas fa-eye"></i>
                                        </x-action-button>
                                        <x-action-button color="yellow" :href="route('produtos.edit', $produto)" title="Editar Produto">
                                            <i class="fas fa-pencil-alt"></i>
                                        </x-action-button>
                                        <form method="POST" action="{{ route('produtos.destroy', $produto) }}" onsubmit="return confirm('ATENÇÃO! Esta ação é irreversível. Tem certeza que deseja EXCLUIR PERMANENTEMENTE este produto?');">
                                            @csrf
                                            @method('DELETE')
                                            <x-action-button type="button" color="red" title="Deletar Produto">
                                                <i class="fas fa-trash-alt"></i>
                                            </x-action-button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $produtos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
