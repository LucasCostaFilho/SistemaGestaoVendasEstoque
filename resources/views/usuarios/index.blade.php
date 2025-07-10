<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Gerenciar Usuários') }}</h2>
            <x-action-button type="link" color="green" :href="route('usuarios.create')">
                <i class="fas fa-plus mr-2"></i> Novo Usuário
            </x-action-button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nome</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">E-mail</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Papéis (Roles)</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($usuarios as $usuario)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $usuario->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $usuario->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{-- Verifica se o relacionamento 'role' não é nulo antes de tentar acessar o nome --}}
                                        @if ($usuario->role)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                {{ $usuario->role->name }}
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                Sem Papel
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex items-center justify-end space-x-2">
                                        <form method="POST" action="{{ route('usuarios.destroy', $usuario) }}" onsubmit="return confirm('Tem certeza?');">
                                            @csrf @method('DELETE')
                                            <x-action-button type="submit" color="red" class="w-8 h-8 justify-center"><i class="fas fa-trash-alt"></i></x-action-button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="px-6 py-4 text-center text-gray-500">Nenhum usuário cadastrado.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">{{ $usuarios->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
