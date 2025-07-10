<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Relatório de Vendas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('relatorios.vendas') }}">
                        @csrf
                        <div class="flex flex-wrap items-end gap-4">
                            <div>
                                <label for="data_inicio" class="block font-medium text-sm text-gray-700">Data de Início</label>
                                <input type="date" name="data_inicio" id="data_inicio" value="{{ $dataInicio }}" class="block mt-1 border-gray-300 rounded-md shadow-sm">
                            </div>
                            <div>
                                <label for="data_fim" class="block font-medium text-sm text-gray-700">Data de Fim</label>
                                <input type="date" name="data_fim" id="data_fim" value="{{ $dataFim }}" class="block mt-1 border-gray-300 rounded-md shadow-sm">
                            </div>
                            <div>
                                <label for="user_id" class="block font-medium text-sm text-gray-700">Vendedor</label>
                                <select name="user_id" id="user_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                                    <option value="">Todos os Vendedores</option>
                                    @foreach ($vendedores as $vendedor)
                                        <option value="{{ $vendedor->id }}" @selected($vendedor->id == $vendedorSelecionadoId)>
                                            {{ $vendedor->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-action-button type="submit" color="blue">Gerar Relatório</x-action-button>
                            </div>
                            <div>
                                <a href="{{ route('relatorios.vendas.pdf', ['data_inicio' => $dataInicio, 'data_fim' => $dataFim, 'user_id' => $vendedorSelecionadoId]) }}"
                                target="_blank"
                                class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                    <i class="fas fa-file-pdf mr-2"></i>
                                    Gerar PDF
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-6">
                <div class="bg-white p-6 rounded-lg shadow-sm"><h3 class="text-sm font-medium text-gray-500">TOTAL VENDIDO</h3><p class="text-2xl font-bold">R$ {{ number_format($totalVendido, 2, ',', '.') }}</p></div>
                <div class="bg-white p-6 rounded-lg shadow-sm"><h3 class="text-sm font-medium text-gray-500">Nº DE VENDAS</h3><p class="text-2xl font-bold">{{ $numeroDeVendas }}</p></div>
                <div class="bg-white p-6 rounded-lg shadow-sm"><h3 class="text-sm font-medium text-gray-500">TICKET MÉDIO</h3><p class="text-2xl font-bold">R$ {{ number_format($ticketMedio, 2, ',', '.') }}</p></div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Vendas no Período</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID Venda</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Data</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Cliente</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Vendedor</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Valor Final</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($vendas as $venda)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">#{{ $venda->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $venda->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ optional($venda->cliente)->nome_completo }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ optional($venda->user)->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right font-semibold">R$ {{ number_format($venda->valor_final, 2, ',', '.') }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="py-4 text-center text-gray-500">Nenhuma venda encontrada para o período selecionado.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
