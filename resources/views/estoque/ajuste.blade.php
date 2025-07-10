<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">{{ __('Ajuste Manual de Estoque') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4 text-gray-800">Registrar um Ajuste</h3>

                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">{{ session('success') }}</div>
                @endif
                @if ($errors->any() || session('error'))
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                        {{ session('error') }}
                        <ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('estoque.ajuste.store') }}">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label for="variacao_produto_id" class="block font-medium text-sm text-gray-700">Produto / Variação</label>
                            <select id="variacao_produto_id" name="variacao_produto_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">Selecione um item...</option>
                                @foreach ($variacoes as $variacao)
                                    <option value="{{ $variacao->id }}" {{ old('variacao_produto_id') == $variacao->id ? 'selected' : '' }}>
                                        {{ $variacao->produto->nome }} (SKU: {{ $variacao->sku }}) - Estoque Atual: {{ $variacao->estoque_atual }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="tipo_ajuste" class="block font-medium text-sm text-gray-700">Tipo de Ajuste</label>
                                <select id="tipo_ajuste" name="tipo_ajuste" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    <option value="">Selecione...</option>
                                    <option value="entrada" {{ old('tipo_ajuste') == 'entrada' ? 'selected' : '' }}>Entrada (Adicionar ao estoque)</option>
                                    <option value="saida" {{ old('tipo_ajuste') == 'saida' ? 'selected' : '' }}>Saída (Remover do estoque)</option>
                                </select>
                            </div>

                            <div>
                                <label for="quantidade" class="block font-medium text-sm text-gray-700">Quantidade</label>
                                <input id="quantidade" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="number" name="quantidade" min="1" value="{{ old('quantidade') }}" required />
                            </div>
                        </div>

                        <div>
                            <label for="motivo" class="block font-medium text-sm text-gray-700">Motivo do Ajuste</label>
                            <textarea id="motivo" name="motivo" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required placeholder="Ex: Contagem de balanço, Produto danificado, Bonificação de fornecedor">{{ old('motivo') }}</textarea>
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-6 pt-6 border-t border-gray-200">
                        <x-action-button type="submit" color="green">
                            <i class="fas fa-save mr-2"></i>
                            Salvar Ajuste
                        </x-action-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
