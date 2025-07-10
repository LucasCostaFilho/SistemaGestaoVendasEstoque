<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Editar Variação do Produto: {{ $variacao->produto->nome }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('variacoes.update', $variacao) }}">
                    @csrf
                    @method('PUT')

                    <h3 class="text-lg font-semibold mb-4 border-b pb-2">Atributos</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-4">
                        @foreach ($atributos as $atributo)
                            <div>
                                <label for="atributo_{{ $atributo->id }}" class="block font-medium text-sm text-gray-700">{{ $atributo->nome }}</label>
                                <select name="valores[]" id="atributo_{{ $atributo->id }}" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                                    <option value="">Selecione...</option>
                                    @foreach ($atributo->valores as $valor)
                                        {{-- A mágica da pré-seleção acontece aqui --}}
                                        <option value="{{ $valor->id }}" @selected(in_array($valor->id, old('valores', $valoresAtuaisIds)))>
                                            {{ $valor->nome }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endforeach
                    </div>

                    <h3 class="text-lg font-semibold mb-4 mt-8 border-b pb-2">Dados da Variação</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="sku" class="block font-medium text-sm text-gray-700">SKU</label>
                            <input id="sku" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="text" name="sku" value="{{ old('sku', $variacao->sku) }}" required />
                        </div>
                        <div>
                            <label for="preco" class="block font-medium text-sm text-gray-700">Preço</label>
                            <input id="preco" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="number" step="0.01" name="preco" value="{{ old('preco', $variacao->preco) }}" required />
                        </div>
                        <div>
                            <label for="estoque_atual" class="block font-medium text-sm text-gray-700">Estoque Atual</label>
                            <input id="estoque_atual" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="number" name="estoque_atual" value="{{ old('estoque_atual', $variacao->estoque_atual) }}" required />
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-6 pt-6 border-t">
                        <x-back-button :href="route('produtos.show', $variacao->produto_id)" />
                        <div class="ms-3">
                            <x-action-button type="submit" color="green">
                                <i class="fas fa-check mr-2"></i>
                                Salvar Alterações
                            </x-action-button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
