<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastrar Novo Usuário') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                           <p class="font-bold">Opa! Algo deu errado:</p>
                           <ul class="mt-2 list-disc list-inside text-sm">
                               @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                           </ul>
                        </div>
                    @endif

                    {{-- Formulário agora aponta para a rota 'usuarios.store' --}}
                    <form method="POST" action="{{ route('usuarios.store') }}">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">

                            {{-- Coluna 1: Dados do Usuário --}}
                            <div class="space-y-4">
                                <div>
                                    <label for="name" class="block font-medium text-sm text-gray-700">Nome Completo</label>
                                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                                </div>

                                <div>
                                    <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                                </div>

                                <div>
                                    <label for="password" class="block font-medium text-sm text-gray-700">Senha</label>
                                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
                                </div>

                                <div>
                                    <label for="password_confirmation" class="block font-medium text-sm text-gray-700">Confirmar Senha</label>
                                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
                                </div>

                                <div class="mt-4">
                                    <label for="role_id" class="block font-medium text-sm text-gray-700">Papel (Role)</label>
                                    <select name="role_id" id="role_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                                        <option value="">Selecione um papel</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Coluna 2: Endereço (Lógica de CEP reutilizada) --}}
                            <div class="space-y-4">
                                <div>
                                    <label for="cep" class="block font-medium text-sm text-gray-700">CEP</label>
                                    <x-text-input id="cep" class="block mt-1 w-full" type="text" name="cep" oninput="formatarCep(this)" placeholder="00000-000" />
                                </div>
                                <div>
                                    <label for="logradouro" class="block font-medium text-sm text-gray-700">Logradouro</label>
                                    <x-text-input id="logradouro" class="block mt-1 w-full" type="text" name="logradouro" />
                                </div>
                                <div>
                                    <label for="numero" class="block font-medium text-sm text-gray-700">Número</label>
                                    <x-text-input id="numero" class="block mt-1 w-full" type="text" name="numero" />
                                </div>
                                <div>
                                    <label for="bairro" class="block font-medium text-sm text-gray-700">Bairro</label>
                                    <x-text-input id="bairro" class="block mt-1 w-full" type="text" name="bairro" />
                                </div>
                                <div>
                                    <label for="cidade" class="block font-medium text-sm text-gray-700">Cidade</label>
                                    <x-text-input id="cidade" class="block mt-1 w-full" type="text" name="cidade" />
                                </div>
                            </div>
                        </div>

                        {{-- Botões de Ação Padronizados --}}
                        <div class="flex items-center justify-end mt-6 pt-6 border-t border-gray-200">
                            <x-back-button :href="route('usuarios.index')" />
                            <div class="ms-3">
                                <x-action-button type="submit" color="green">
                                    <i class="fas fa-user-plus mr-2"></i>
                                    Cadastrar Usuário
                                </x-action-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Script de máscara e busca de CEP reutilizado --}}
    <script>
        function formatarCep(input) {
            let value = input.value.replace(/\D/g, '');
            if (value.length > 8) value = value.slice(0, 8);
            if (value.length >= 6) {
                input.value = value.slice(0, 5) + '-' + value.slice(5);
            } else {
                input.value = value;
            }
            if (value.length === 8) {
                buscarCep(value);
            }
        }

        function buscarCep(cep) {
            fetch(`https://viacep.com.br/ws/${cep}/json/`)
                .then(response => response.json())
                .then(data => {
                    if (data.erro) {
                        alert('CEP não encontrado!');
                        return;
                    }
                    document.getElementById('logradouro').value = data.logradouro || '';
                    document.getElementById('bairro').value = data.bairro || '';
                    document.getElementById('cidade').value = data.localidade || '';
                })
                .catch(() => {
                    alert('Erro ao buscar CEP!');
                });
        }
    </script>
</x-app-layout>
