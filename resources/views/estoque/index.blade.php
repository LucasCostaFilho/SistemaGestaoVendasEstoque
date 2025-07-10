<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Gestão de Estoque e Movimentações') }}
            </h2>
            <x-action-button type="link" color="blue" :href="route('estoque.ajuste.create')">
                <i class="fas fa-plus mr-2"></i>
                Fazer Ajuste Manual
            </x-action-button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Log de Movimentações Recentes</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Data</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produto</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Tipo</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Quantidade</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Referência</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Usuário</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($movimentacoes as $mov)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ \Carbon\Carbon::parse($mov->data_movimentacao)->format('d/m/Y H:i') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap font-medium">{{ optional($mov->variacaoProduto->produto)->nome }} (SKU: {{ optional($mov->variacaoProduto)->sku }})</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            @if ($mov->tipo === 'entrada')
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Entrada</span>
                                            @else
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Saída</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center font-bold">{{ $mov->quantidade }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $mov->observacao }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                            @php
                                                $usuario = null;
                                                if ($mov->referencia instanceof \App\Models\ItemVenda) {
                                                    $usuario = $mov->referencia->venda->user;
                                                } elseif ($mov->referencia instanceof \App\Models\ItemPedidoCompra) {
                                                    $usuario = $mov->referencia->pedidoCompra->user;
                                                } elseif ($mov->referencia instanceof \App\Models\AjusteEstoque) {
                                                    $usuario = $mov->referencia->user;
                                                }
                                            @endphp
                                            {{ $usuario->name ?? 'Sistema' }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">Nenhuma movimentação de estoque registrada ainda.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $movimentacoes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
