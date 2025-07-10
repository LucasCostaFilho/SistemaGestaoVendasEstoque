<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Detalhes do Produto: {{ $produto->nome }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg" role="alert">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg" role="alert">
                            <p>{{ session('error') }}</p>
                        </div>
                    @endif
                    <div class="mb-6 pb-4 border-b">
                        <h3 class="text-lg font-bold mb-2">{{ $produto->nome }}</h3>
                        <p><strong>Marca:</strong> {{ $produto->marca ?? 'Não informada' }}</p>
                        <p><strong>Categoria:</strong>
                            @if ($produto->categoria)
                                @if ($produto->categoria->trashed())
                                    <span class="line-through text-red-500">{{ $produto->categoria->nome }}</span>
                                    <span class="text-xs text-red-700 bg-red-100 px-2 py-1 rounded-full ms-2">Desativada</span>
                                @else
                                    {{ $produto->categoria->nome }}
                                @endif
                            @else
                                Sem Categoria
                            @endif
                        </p>
                    </div>

                    <h4 class="text-md font-bold mb-4">Variações e Estoque</h4>

                    <div class="mb-6 overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Atributos</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">SKU</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Preço</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Estoque</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($produto->variacoes as $variacao)
                                    <tr>
                                        <td class="px-4 py-2 whitespace-nowrap">
                                            @foreach ($variacao->valores as $valor)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                    {{ $valor->atributo->nome ?? 'Atributo' }}: {{ $valor->valor }}
                                                </span>
                                            @endforeach
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ $variacao->sku }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">R$ {{ number_format($variacao->preco, 2, ',', '.') }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ $variacao->estoque_atual }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-sm font-medium flex items-center space-x-2">
                                            <x-action-button type="link" color="yellow" :href="route('variacoes.edit', $variacao)" title="Editar Variação" class="w-8 h-8 justify-center">
                                                <i class="fas fa-pencil-alt"></i>
                                            </x-action-button>

                                            <form method="POST" action="{{ route('variacoes.destroy', $variacao) }}" onsubmit="return confirm('Tem certeza que deseja mover esta variação para a lixeira?');">
                                                @csrf @method('DELETE')
                                                <x-action-button type="submit" color="red" title="Excluir Variação" class="w-8 h-8 justify-center">
                                                    <i class="fas fa-trash-alt"></i>
                                                </x-action-button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-4 py-4 text-center text-gray-500">Nenhuma variação cadastrada para este produto.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-8 pt-6 border-t">
                        <h5 class="text-md font-bold mb-4">Adicionar Nova Variação</h5>
                        <form method="POST" action="{{ route('variacoes.store', $produto) }}">
                            @csrf

                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4 p-4 border rounded-md bg-gray-50">
                                <h6 class="col-span-full font-semibold text-sm text-gray-600">Selecione os Atributos</h6>
                                @foreach ($atributos as $atributo)
                                    <div>
                                        <label for="atributo_{{ $atributo->id }}" class="block font-medium text-sm text-gray-700">{{ $atributo->nome }}</label>
                                        <select name="valores[]" id="atributo_{{ $atributo->id }}" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                                            <option value="">Selecione...</option>
                                            @foreach ($atributo->valores as $valor)
                                                <option value="{{ $valor->id }}">{{ $valor->valor }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endforeach
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label for="sku" class="block font-medium text-sm text-gray-700">SKU</label>
                                    <input type="text" name="sku" id="sku" value="{{ old('sku') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                </div>
                                <div>
                                    <label for="preco" class="block font-medium text-sm text-gray-700">Preço</label>
                                    <input type="number" step="0.01" name="preco" id="preco" value="{{ old('preco') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                </div>
                            </div>

                            <div class="flex justify-end mt-4">
                                <x-action-button type="submit" color="green">
                                    <i class="fas fa-plus mr-2"></i>
                                    Adicionar Variação
                                </x-action-button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
