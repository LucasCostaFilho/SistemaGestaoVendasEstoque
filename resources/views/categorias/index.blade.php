<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Categorias de Produto') }}
            </h2>
            <x-action-button type="link" color="green" :href="route('categorias.create')">
                <i class="fas fa-add mr-2"></i>
                Cadastrar Categoria
            </x-action-button>
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
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($categorias as $categoria)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $categoria->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $categoria->nome }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap flex items-center space-x-2">
                                        <x-action-button color="yellow" :href="route('categorias.edit', $categoria)" title="Editar Categoria">
                                            <i class="fas fa-pencil-alt"></i>
                                        </x-action-button>
                                        <form method="POST" action="{{ route('categorias.destroy', $categoria) }}" onsubmit="return confirm('Tem certeza que deseja excluir esta categoria? Esta ação não pode ser desfeita.');">
                                            @csrf
                                            @method('DELETE')
                                            <x-action-button type="button" color="red" title="Excluir Categoria">
                                                <i class="fas fa-trash-alt"></i>
                                            </x-action-button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                     <div class="mt-4">
                        {{ $categorias->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
