<x-guest-layout>
    <form method="POST" action="{{ route('login') }}" class="text-left space-y-4">
    @csrf
    <div class="flex justify-center">
        <h2 class="text-xl font-semibold mb-4">LOGIN</h2>
    </div>
    <!-- Campo Email -->
    <div>
        <x-text-input
            id="email"
            name="email"
            type="email"
            :value="old('email')"
            required
            autofocus
            autocomplete="username"
            placeholder="Email"
            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-green-600 focus:outline-none text-sm sm:text-base"
        />
        <x-input-error :messages="$errors->get('email')" class="mt-1 text-sm text-red-600" />
    </div>

    <!-- Campo Senha -->
    <div>
        <x-text-input
            id="password"
            name="password"
            type="password"
            required
            autocomplete="current-password"
            placeholder="Senha"
            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-green-600 focus:outline-none text-sm sm:text-base"
        />
        <x-input-error :messages="$errors->get('password')" class="mt-1 text-sm text-red-600" />
    </div>

    <!-- Lembre-se de mim -->
    <div class="flex items-center justify-between text-sm">
        <label for="remember_me" class="inline-flex items-center">
            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500" name="remember">
            <span class="ms-2 text-gray-700">Lembre-se de mim</span>
        </label>

        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="text-green-700 hover:underline">
                Esqueceu sua senha?
            </a>
        @endif
    </div>

    <!-- Botão Entrar -->
    <div class="pt-4">
        <x-primary-button class="w-full bg-green-600 hover:bg-green-700 text-white py-2 text-sm sm:text-base flex justify-center items-center text-center">
            Entrar
        </x-primary-button>
    </div>
</form>

</x-guest-layout>
