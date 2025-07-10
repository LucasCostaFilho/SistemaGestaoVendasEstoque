<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Editar Valor do Atributo: <span class="font-bold">{{ $valor->atributo->nome }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('valores.update', $valor) }}">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="valor" class="block font-medium text-sm text-gray-700">Nome do Valor</label>
                        <input id="valor" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="text" name="valor" value="{{ old('valor', $valor->valor) }}" required />
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <x-back-button :href="route('atributos.show', $valor->atributo_id)" />
                        <div class="ms-3">
                            <x-action-button type="submit" color="green">Salvar Alterações</x-action-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
