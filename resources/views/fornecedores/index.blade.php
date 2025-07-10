<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">{{ __('Gerenciar Fornecedores') }}</h2>
            <x-action-button type="link" color="green" :href="route('fornecedores.create')">
                <i class="fas fa-plus mr-2"></i> Novo Fornecedor
            </x-action-button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Mensagens de sucesso ou erro --}}
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Razão Social</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">CNPJ</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">E-mail</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($fornecedores as $fornecedor)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $fornecedor->razao_social }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $fornecedor->cnpj }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $fornecedor->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex items-center justify-end space-x-2">
                                        <x-action-button type="link" color="yellow" :href="route('fornecedores.edit', $fornecedor)" class="w-8 h-8 justify-center"><i class="fas fa-pencil-alt"></i></x-action-button>
                                        <form method="POST" action="{{ route('fornecedores.destroy', $fornecedor) }}" onsubmit="return confirm('Tem certeza?');">
                                            @csrf @method('DELETE')
                                            <x-action-button type="submit" color="red" class="w-8 h-8 justify-center"><i class="fas fa-trash-alt"></i></x-action-button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="px-6 py-4 text-center text-gray-500">Nenhum fornecedor cadastrado.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">{{ $fornecedores->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
