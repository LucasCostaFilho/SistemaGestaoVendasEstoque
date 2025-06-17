<x-guest-layout>
    <div class="flex justify-center">
        <h2 class="text-xl font-semibold mb-4">REDEFINIR SENHA</h2>
    </div>

    <div class="mb-4 text-base text-gray-600">
        {{ __('Informe seu endereço de e-mail e enviaremos um link para redefinição de senha que permitirá que você escolha uma nova.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="flex justify-start y-2 text-sm sm:text-base"/>
            <x-text-input id="email"
            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-green-600 focus:outline-none text-sm sm:text-base"
            placeholder="email@exemple"
            type="email" name="email" :value="old('email')" required autofocus
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-6">
            @if (Route::has('login'))
                <a href="{{ route('login') }}" class="text-green-700 hover:underline">
                    CANCELAR
                </a>
            @endif
            <x-primary-button class="bg-green-600 hover:bg-green-700 text-white py-2 text-sm sm:text-base flex justify-center items-center text-center">
                {{ __('ENVIAR LINK') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
