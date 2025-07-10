<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Vendas</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 11px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px;}
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h1 { text-align: center; }
        .info { margin-bottom: 20px; }
        .total { font-weight: bold; font-size: 14px; text-align: right; margin-top: 20px;}
    </style>
</head>
<body>
    <h1>Relatório de Vendas</h1>
    <div class="info">
        <p><strong>Período de:</strong> {{ \Carbon\Carbon::parse($dataInicio)->format('d/m/Y') }} a {{ \Carbon\Carbon::parse($dataFim)->format('d/m/Y') }}</p>
        @if($vendedor)
            <p><strong>Vendedor:</strong> {{ $vendedor->name }}</p>
        @endif
    </div>
    <hr>

    <table>
        <thead>
            <tr>
                <th>ID Venda</th>
                <th>Data</th>
                <th>Cliente</th>
                <th>Vendedor</th>
                <th>Valor Final</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($vendas as $venda)
                <tr>
                    <td>#{{ $venda->id }}</td>
                    <td>{{ $venda->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ optional($venda->cliente)->nome_completo }}</td>
                    <td>{{ optional($venda->user)->name }}</td>
                    <td>R$ {{ number_format($venda->valor_final, 2, ',', '.') }}</td>
                </tr>
            @empty
                <tr><td colspan="5" style="text-align: center;">Nenhuma venda encontrada para os filtros selecionados.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="total">
        Valor Total Vendido: R$ {{ number_format($totalVendido, 2, ',', '.') }}
    </div>
</body>
</html>
