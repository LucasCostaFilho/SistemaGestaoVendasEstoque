<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="flex justify-center">
            <h2 class="text-xl font-semibold mb-4">CADASTRO DE USUÁRIO</h2>
        </div>

        <div class="md:flex md:space-x-6">
            <!-- Coluna 1: dados principais -->
            <div class="md:w-1/2 space-y-4">
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" 
                        class="block mt-1 w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-green-600 focus:outline-none text-sm sm:text-base"
                        type="text" name="name"
                        placeholder="Nome"
                        :value="old('name')" required autofocus autocomplete="name"
                    />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"  placeholder="Email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    placeholder="Senha"
                                    required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation"
                                    placeholder="Confirmar senha"
                                    required autocomplete="new-password"
                    />
                                    
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
                
                <!-- Role (Regra de usuário) -->
                <div class="mt-4">
                    <x-input-label for="role_id" :value="__('Tipo de Usuário')" />
                    <select id="role_id" name="role_id" required
                        class="block mt-1 w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-green-600 focus:outline-none text-sm sm:text-base">
                        <option value="">Selecione uma regra</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('role_id')" class="mt-2" />
                </div>

                <!-- Telefone -->
                <div class="mt-4">
                    <x-input-label for="telefone" :value="__('Telefone')" />
                    <x-text-input id="telefone" class="block mt-1 w-full" type="text" name="telefone"
                        placeholder="(99) 99999-9999" oninput="formatarTelefone(this)" required />
                    <x-input-error :messages="$errors->get('telefone')" class="mt-2" />
                </div>
            </div>

            <!-- Coluna 2: endereço -->
            <div class="md:w-1/2 space-y-4">
                
                    <!-- CEP -->
                    <div>
                        <x-input-label for="cep" :value="__('Seu CEP')" />
                        <x-text-input id="cep" class="block mt-1 w-full" type="text" name="cep"
                            placeholder="00000-000" oninput="formatarCep(this)" required />
                        <x-input-error :messages="$errors->get('cep')" class="mt-2" />
                    </div>
                    <!-- Logradouro -->
                    <div class="mt-2">
                        <x-input-label for="logradouro" :value="__('Logradouro')" />
                        <x-text-input id="logradouro" class="block mt-1 w-full" type="text" name="logradouro"
                            placeholder="Rua Exemplo" :value="old('logradouro')" required />
                        <x-input-error :messages="$errors->get('logradouro')" class="mt-2" />
                    </div>
                    <!-- Numero -->
                    <div class="mt-4">
                        <x-input-label for="numero" :value="__('Numero')" />
                        <x-text-input id="numero" class="block mt-1 w-full" type="text" name="numero"
                            placeholder="Número" :value="old('numero')" required />
                        <x-input-error :messages="$errors->get('numero')" class="mt-2" />
                    </div>
                    <!-- Complemento -->
                    <div class="mt-4">
                        <x-input-label for="complemento" :value="__('Complemento')" />
                        <x-text-input id="complemento" class="block mt-1 w-full" type="text" name="complemento"
                            placeholder="Complemento" :value="old('complemento')" required />
                        <x-input-error :messages="$errors->get('complemento')" class="mt-2" />
                    </div>
                    <!-- Bairro -->
                    <div class="mt-4">
                        <x-input-label for="bairro" :value="__('Bairro')" />
                        <x-text-input id="bairro" class="block mt-1 w-full" type="text" name="bairro"
                            placeholder="Bairro" :value="old('bairro')" required />
                        <x-input-error :messages="$errors->get('bairro')" class="mt-2" />
                    </div>

                    <!-- Cidade -->
                    <div class="mt-4">
                        <x-input-label for="cidade" :value="__('Cidade')" />
                        <x-text-input id="cidade" class="block mt-1 w-full" type="text" name="cidade"
                            placeholder="Cidade" :value="old('cidade')" required />
                        <x-input-error :messages="$errors->get('cidade')" class="mt-2" />
                    </div>
                </div>
            </div>

        <!-- Botão e link de login -->
        <div class="flex items-center justify-between mt-6">
            <a class="text-green-700 hover:underline" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4 bg-green-600 hover:bg-green-700 text-white">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
<script>
    function formatarCep(input) {
        let value = input.value.replace(/\D/g, '');

        if (value.length > 8) value = value.slice(0, 8);

        if (value.length >= 6) {
            input.value = value.slice(0, 5) + '-' + value.slice(5);
        } else {
            input.value = value;
        }

        // Chama buscarCep automaticamente quando completar 8 dígitos
        if (value.length === 8) {
            buscarCep(value);
        }
    }

    function buscarCep(cep = null) {
        cep = cep || document.getElementById('cep').value.replace(/\D/g, '');

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

    function formatarTelefone(input) {
        let value = input.value.replace(/\D/g, '');

        if (value.length > 11) value = value.slice(0, 11);

        if (value.length >= 2 && value.length <= 6) {
            input.value = `(${value.slice(0, 2)}) ${value.slice(2)}`;
        } else if (value.length > 6) {
            input.value = `(${value.slice(0, 2)}) ${value.slice(2, 7)}-${value.slice(7)}`;
        } else {
            input.value = value;
        }
    }
</script>
