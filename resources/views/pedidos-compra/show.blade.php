<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Pedido de Compra #{{ $pedido->id }} - {{ ($pedido->fornecedor)->razao_social }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg" role="alert">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg" role="alert">{{ session('error') }}</div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Itens do Pedido</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Produto/Variação</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Quantidade</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Custo Unitário</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                                    <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($pedido->itens as $item)
                                    <tr>
                                        <td class="px-4 py-2">{{ optional($item->variacaoProduto->produto)->nome }} (SKU: {{ optional($item->variacaoProduto)->sku }})</td>
                                        <td class="px-4 py-2">{{ $item->quantidade }}</td>
                                        <td class="px-4 py-2">R$ {{ number_format($item->custo_unitario, 2, ',', '.') }}</td>
                                        <td class="px-4 py-2">R$ {{ number_format($item->quantidade * $item->custo_unitario, 2, ',', '.') }}</td>
                                        <td class="px-4 py-2 text-right">
                                            <form method="POST" action="{{ route('item-pedidos-compra.destroy', ['item' => $item->id]) }}" onsubmit="return confirm('Tem certeza que deseja remover este item?');">
                                                @csrf
                                                @method('DELETE')
                                                <x-action-button type="submit" color="red" title="Remover Item" class="w-8 h-8 justify-center">
                                                    <i class="fas fa-trash-alt"></i>
                                                </x-action-button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="py-4 text-center text-gray-500">Nenhum item adicionado a este pedido.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- SEÇÃO PARA ADICIONAR NOVO ITEM (só aparece se o pedido for um rascunho) --}}
            @if ($pedido->status === 'rascunho')
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold mb-4">Adicionar Item ao Pedido</h3>

                        {{-- Exibição de erros de validação do formulário --}}
                        @if ($errors->any())
                            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg text-sm">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('item-pedidos-compra.store', $pedido) }}">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                                <div class="md:col-span-2">
                                    <label for="variacao_produto_id" class="block font-medium text-sm text-gray-700">Produto / Variação</label>
                                    <select id="variacao_produto_id" name="variacao_produto_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                                        <option value="">Selecione um item...</option>
                                        @foreach ($variacoes as $variacao)
                                            <option value="{{ $variacao->id }}" {{ old('variacao_produto_id') == $variacao->id ? 'selected' : '' }}>
                                                {{ $variacao->produto->nome }} (SKU: {{ $variacao->sku }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="quantidade" class="block font-medium text-sm text-gray-700">Quantidade</label>
                                    <input id="quantidade" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="number" name="quantidade" min="1" value="{{ old('quantidade') }}" required />
                                </div>
                                <div>
                                    <label for="custo_unitario" class="block font-medium text-sm text-gray-700">Custo Unitário (R$)</label>
                                    <input id="custo_unitario" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="number" step="0.01" name="custo_unitario" value="{{ old('custo_unitario') }}" required />
                                </div>
                            </div>
                            <div class="flex justify-end mt-4">
                                <x-action-button type="submit" color="blue">
                                    <i class="fas fa-plus mr-2"></i>
                                    Adicionar Item
                                </x-action-button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif

            {{-- BOTÕES DE AÇÃO PRINCIPAIS --}}
            <div class="flex items-center justify-between mt-6">
                <x-back-button :href="route('pedidos-compra.index')" />
                @if ($pedido->status === 'rascunho' && $pedido->itens->isNotEmpty())
                    <form method="POST" action="{{ route('pedidos-compra.receber', $pedido) }}" onsubmit="return confirm('Você confirma o recebimento de todos os itens deste pedido? Esta ação atualizará o estoque.');">
                        @csrf
                        <x-action-button type="submit" color="green">
                            <i class="fas fa-truck-loading mr-2"></i>
                            Confirmar Recebimento
                        </x-action-button>
                    </form>
                @elseif($pedido->status !== 'rascunho')
                    <span class="px-4 py-2 bg-gray-200 text-gray-500 rounded-md text-sm font-semibold">Pedido já processado</span>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
