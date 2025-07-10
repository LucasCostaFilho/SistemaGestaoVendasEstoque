<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Relatório de Itens com Estoque Baixo (Igual ou Abaixo de {{ $limite }} Unidades)
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produto</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Variação (Atributos)</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">SKU</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Estoque Atual</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($variacoes as $variacao)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap font-medium">{{ $variacao->produto->nome }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @foreach ($variacao->valores as $valor)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                    {{ $valor->atributo->nome }}: {{ $valor->valor }}
                                                </span>
                                            @endforeach
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $variacao->sku }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <span class="px-3 py-1 inline-flex text-sm leading-5 font-bold rounded-full bg-red-100 text-red-800">
                                                {{ $variacao->estoque_atual }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <x-action-button type="link" color="blue" :href="route('produtos.show', $variacao->produto)">
                                                Ver Produto
                                            </x-action-button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                            Nenhum item com estoque baixo no momento.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $variacoes->links() }}
                    </div>
                </div>
            </div>
            <div class="mt-6">
                <x-back-button :href="route('dashboard')" />
            </div>
        </div>
    </div>
</x-app-layout>
