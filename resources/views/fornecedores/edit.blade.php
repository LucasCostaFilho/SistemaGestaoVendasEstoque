<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Editar Fornecedor: ') }} {{ $fornecedor->razao_social }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

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

                    <form method="POST" action="{{ route('fornecedores.update', $fornecedor) }}">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="razao_social" class="block font-medium text-sm text-gray-700">Razão Social</label>
                                <input id="razao_social" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="text" name="razao_social" value="{{ old('razao_social', $fornecedor->razao_social) }}" required autofocus />
                            </div>

                            <div>
                                <label for="cnpj" class="block font-medium text-sm text-gray-700">CNPJ</label>
                                <input id="cnpj" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="text" name="cnpj" value="{{ old('cnpj', $fornecedor->cnpj) }}" required />
                            </div>

                            <div>
                                <label for="email" class="block font-medium text-sm text-gray-700">E-mail</label>
                                <input id="email" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="email" name="email" value="{{ old('email', $fornecedor->email) }}" />
                            </div>

                            <div>
                                <label for="telefone" class="block font-medium text-sm text-gray-700">Telefone</label>
                                <input id="telefone" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="text" name="telefone" value="{{ old('telefone', $fornecedor->telefone) }}" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6 pt-6 border-t">
                            <x-back-button :href="route('fornecedores.index')" />
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
