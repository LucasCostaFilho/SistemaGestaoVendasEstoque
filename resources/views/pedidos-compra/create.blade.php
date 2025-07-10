<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">{{ __('Criar Novo Pedido de Compra') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Passo 1: Selecione o Fornecedor</h3>
                <form method="POST" action="{{ route('pedidos-compra.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="fornecedor_id" class="block font-medium text-sm text-gray-700">Fornecedor</label>
                        <select id="fornecedor_id" name="fornecedor_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                            <option value="">Selecione...</option>
                            @foreach ($fornecedores as $fornecedor)
                                <option value="{{ $fornecedor->id }}">{{ $fornecedor->razao_social }} ({{ $fornecedor->cnpj }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-center justify-end mt-6 pt-6 border-t">
                        <x-back-button :href="route('pedidos-compra.index')" />
                        <div class="ms-3">
                            <x-action-button type="submit" color="green">
                                <i class="fas fa-arrow-right mr-2"></i>
                                Continuar e Adicionar Itens
                            </x-action-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
