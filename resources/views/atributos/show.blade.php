<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gerenciar Valores do Atributo: <span class="font-bold">{{ $atributo->nome }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- COLUNA DA ESQUERDA: Formulário para Adicionar Novo Valor --}}
                <div class="md:col-span-1">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold mb-4">Adicionar Novo Valor</h3>

                        @if ($errors->any())
                            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg text-sm">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('valores.store', $atributo) }}">
                            @csrf
                            <div>
                                <label for="valor" class="block font-medium text-sm text-gray-700">Nome do Valor</label>
                                <input id="valor" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="text" name="valor" value="{{ old('valor') }}" required autofocus placeholder="Ex: Vermelho, P, 110V" />
                            </div>
                            <div class="flex justify-end mt-4">
                                <x-action-button type="submit" color="green">Adicionar</x-action-button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- COLUNA DA DIREITA: Tabela com Valores Existentes --}}
                <div class="md:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold mb-4">Valores Existentes</h3>
                        <table class="min-w-full divide-y divide-gray-200">
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($atributo->valores as $valor)
                                    <tr>
                                        <td class="px-2 py-3">{{ $valor->valor }}</td>
                                        <td class="px-2 py-3 flex justify-end space-x-2">
                                            {{-- Futuramente, botões de editar e excluir valor --}}
                                            <x-action-button type="link" color="yellow" :href="route('valores.edit', $valor)" class="w-8 h-8 justify-center"><i class="fas fa-pencil-alt"></i></x-action-button>
                                            <form method="POST" action="{{ route('valores.destroy', $valor) }}" onsubmit="return confirm('Tem certeza que deseja excluir este valor?');">
                                                @csrf
                                                @method('DELETE')
                                                <x-action-button type="submit" color="red" title="Excluir Valor" class="w-8 h-8 justify-center">
                                                    <i class="fas fa-trash-alt"></i>
                                                </x-action-button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="px-2 py-3 text-gray-500">Nenhum valor cadastrado para este atributo.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="mt-6">
                <x-back-button :href="route('atributos.index')" />
            </div>
        </div>
    </div>
</x-app-layout>