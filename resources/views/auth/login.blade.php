<x-guest-layout>
    <form method="POST" action="{{ route('login') }}" class="text-left space-y-4">
    @csrf

    <div>
        <x-text-input id="email" class="w-full" type="email" name="email" :value="old('email')" required autofocus placeholder="Email" />
        <x-input-error :messages="$errors->get('email')" class="mt-1 text-sm text-red-600" />
    </div>

    <div>
        <x-text-input id="password" class="w-full" type="password" name="password" required placeholder="Senha" />
        <x-input-error :messages="$errors->get('password')" class="mt-1 text-sm text-red-600" />
    </div>

    <div class="text-right">
        @if (Route::has('password.request'))
            <a class="text-sm font-semibold text-black hover:underline" href="{{ route('password.request') }}">
                Esqueceu sua senha ?
            </a>
        @endif
    </div>

    <div class="pt-4">
        <x-primary-button class="w-full bg-green-600 hover:bg-green-700">
            Entrar
        </x-primary-button>
    </div>
</form>

</x-guest-layout>
