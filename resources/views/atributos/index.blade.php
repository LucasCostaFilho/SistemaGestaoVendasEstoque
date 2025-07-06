<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Gerenciar Atributos') }}
            </h2>
            
            {{-- Botão para ir para a tela de cadastro --}}
            <x-action-button type="link" color="green" :href="route('atributos.create')">
                <i class="fas fa-plus mr-2"></i>
                Novo Atributo
            </x-action-button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Mensagem de sucesso --}}
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
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($atributos as $atributo)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $atributo->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $atributo->nome }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex items-center justify-end space-x-2">
                                        
                                        {{-- O botão mais importante: Gerenciar os valores (Vermelho, Azul, P, M, etc) --}}
                                        <x-action-button type="link" color="blue" :href="route('atributos.show', $atributo)">
                                            <i class="fas fa-list-ol mr-2"></i>
                                            Gerenciar Valores
                                        </x-action-button>
                                        
                                        {{-- Botão de Editar o nome do Atributo --}}
                                        <x-action-button type="link" color="yellow" :href="route('atributos.edit', $atributo)" title="Editar Atributo" class="w-8 h-8 justify-center">
                                            <i class="fas fa-pencil-alt"></i>
                                        </x-action-button>

                                        {{-- Botão de Deletar o Atributo --}}
                                        <form method="POST" action="{{ route('atributos.destroy', $atributo) }}" onsubmit="return confirm('ATENÇÃO! Excluir um atributo também excluirá todos os seus valores associados. Deseja continuar?');">
                                            @csrf
                                            @method('DELETE')
                                            <x-action-button type="submit" color="red" title="Excluir Atributo" class="w-8 h-8 justify-center">
                                                <i class="fas fa-trash-alt"></i>
                                            </x-action-button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-center text-gray-500">Nenhum atributo cadastrado.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                     <div class="mt-4">
                        {{ $atributos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>