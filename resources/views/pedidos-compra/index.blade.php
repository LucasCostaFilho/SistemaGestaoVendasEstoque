<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">{{ __('Pedidos de Compra') }}</h2>
            <x-action-button type="link" color="green" :href="route('pedidos-compra.create')">
                <i class="fas fa-plus mr-2"></i> Novo Pedido
            </x-action-button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fornecedor</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Data</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($pedidos as $pedido)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">#{{ $pedido->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $pedido->fornecedor->razao_social }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $pedido->created_at->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap"><span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">{{ $pedido->status }}</span></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <x-action-button type="link" color="blue" :href="route('pedidos-compra.show', $pedido)">
                                            Ver / Gerenciar Itens
                                        </x-action-button>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="px-6 py-4 text-center text-gray-500">Nenhum pedido de compra encontrado.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">{{ $pedidos->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
