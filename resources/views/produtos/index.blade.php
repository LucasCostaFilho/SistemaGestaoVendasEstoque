<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Produtos</title>
    {{-- Futuramente, você pode adicionar um link para o CSS aqui --}}
</head>
<body>
    <h1>Lista de Produtos</h1>

    {{-- Futuramente, um botão para adicionar novo produto --}}
    {{-- <a href="{{ route('produtos.create') }}">Adicionar Novo Produto</a> --}}

    <hr>

    <ul>
        @forelse ($produtos as $produto)
            <li>
                <strong>{{ $produto->nome }}</strong> ({{ $produto->marca }})
            </li>
        @empty
            <li>Nenhum produto cadastrado ainda.</li>
        @endforelse
    </ul>

    {{-- Links da paginação --}}
    {{ $produtos->links() }}

</body>
</html>
