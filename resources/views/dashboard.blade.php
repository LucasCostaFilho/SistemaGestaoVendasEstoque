<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Grid para os cards de métricas --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="font-semibold text-sm text-gray-500 uppercase tracking-wider">Vendas de Hoje</h3>
                        <p class="text-3xl font-bold mt-2">
                            R$ {{ number_format($totalVendasHoje, 2, ',', '.') }}
                        </p>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="font-semibold text-sm text-gray-500 uppercase tracking-wider">Nº de Vendas Hoje</h3>
                        <p class="text-3xl font-bold mt-2">
                            {{ $numeroVendasHoje }}
                        </p>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg lg:col-span-2">
                    <div class="p-6 text-gray-900">
                        <h3 class="font-semibold text-sm text-gray-500 uppercase tracking-wider">Produtos Mais Vendidos (Mês)</h3>
                        <ol class="mt-2 list-decimal list-inside space-y-1">
                            @forelse ($topProdutos as $item)
                                <li class="text-sm">
                                    <span class="font-semibold">{{ optional($item->variacaoProduto->produto)->nome }}</span>
                                    <span class="text-gray-600">(SKU: {{ optional($item->variacaoProduto)->sku }})</span>
                                    - <span class="font-bold text-blue-600">{{ $item->total_vendido }} un.</span>
                                </li>
                            @empty
                                <p class="text-sm text-gray-500">Nenhuma venda registrada este mês.</p>
                            @endforelse
                        </ol>
                    </div>
                </div>

                {{-- Card 4 --}}
                <a href="{{ route('relatorios.estoque.baixo') }}" class="block p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-gray-50 transition duration-150 ease-in-out">
                    <div class="text-gray-900">
                        <h3 class="font-semibold text-sm text-red-600 uppercase tracking-wider">Itens com Estoque Baixo</h3>
                        <p class="text-3xl font-bold mt-2 text-red-600">
                            {{ $produtosBaixoEstoqueCount }}
                        </p>
                    </div>
                </a>

            </div>

        </div>
    </div>
</x-app-layout>
