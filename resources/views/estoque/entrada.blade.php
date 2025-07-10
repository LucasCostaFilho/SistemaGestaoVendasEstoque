<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Registrar Entrada de Estoque') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg" role="alert">
                            <p class="font-bold">Opa! Algo deu errado:</p>
                            <ul class="mt-2 list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('estoque.entrada.store') }}">
                        @csrf
                        <div class="mb-4">
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

                        <div class="mb-4">
                            <label for="quantidade" class="block font-medium text-sm text-gray-700">Quantidade de Entrada</label>
                            <input id="quantidade" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="number" name="quantidade" min="1" value="{{ old('quantidade') }}" required />
                        </div>

                        <div class="mt-4">
                            <label for="observacao" class="block font-medium text-sm text-gray-700">Observação (Opcional)</label>
                            <textarea id="observacao" name="observacao" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Ex: Compra do fornecedor TechImports, Nota Fiscal #12345">{{ old('observacao') }}</textarea>
                        </div>

                        <div class="flex items-center justify-end mt-6 pt-6 border-t border-gray-200">
                            <x-action-button type="submit" color="green">
                                <i class="fas fa-plus mr-2"></i>
                                Registrar Entrada
                            </x-action-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
