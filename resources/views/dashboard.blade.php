<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Container para os cards do menu. Usando Grid para o layout. --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-medium text-gray-900">
                            Gerenciar Produtos
                        </h3>
                        <p class="mt-1 text-sm text-gray-600">
                            Acesse para cadastrar, visualizar, editar e remover produtos do seu sistema.
                        </p>
                        <div class="mt-4">
                            <a href="{{ route('produtos.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                Ir para Produtos
                            </a>
                        </div>
                    </div>
                </div>

                {{--
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-medium text-gray-900">
                            Gerenciar Clientes
                        </h3>
                        <p class="mt-1 text-sm text-gray-600">
                            Visualize e gerencie a sua base de clientes cadastrados.
                        </p>
                        <div class="mt-4">
                            <a href="#" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                Ir para Clientes
                            </a>
                        </div>
                    </div>
                </div>
                --}}

            </div>
        </div>
    </div>
</x-app-layout>
