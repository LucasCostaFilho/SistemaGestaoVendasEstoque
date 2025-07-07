<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CategoriaProdutoController;
use App\Http\Controllers\VariacaoProdutoController;
use App\Http\Controllers\AtributoController;
use App\Http\Controllers\ValorAtributoController;
use App\Http\Controllers\PedidoCompraController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\ItemPedidoCompraController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VendaController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    
    // Rota do Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Rotas de Perfil do Usuário
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('produtos', ProdutoController::class);

    Route::resource('categorias', CategoriaProdutoController::class);

    // --- ROTAS DE VARIAÇÕES

    Route::post('/produtos/{produto}/variacoes', [VariacaoProdutoController::class, 'store'])->name('variacoes.store');
    Route::get('/variacoes/{variacao}/edit', [VariacaoProdutoController::class, 'edit'])->name('variacoes.edit');

    Route::put('/variacoes/{variacao}', [VariacaoProdutoController::class, 'update'])->name('variacoes.update');
    
    Route::delete('/variacoes/{variacao}', [VariacaoProdutoController::class, 'destroy'])->name('variacoes.destroy');

    Route::resource('atributos', AtributoController::class);

    Route::post('/atributos/{atributo}/valores', [ValorAtributoController::class, 'store'])->name('valores.store');
    Route::delete('/valores/{valor}', [ValorAtributoController::class, 'destroy'])->name('valores.destroy');
    Route::get('/valores/{valor}/edit', [ValorAtributoController::class, 'edit'])->name('valores.edit');
    Route::put('/valores/{valor}', [ValorAtributoController::class, 'update'])->name('valores.update');

    Route::resource('pedidos-compra', PedidoCompraController::class)
        ->parameters(['pedidos-compra' => 'pedidoCompra']);

    Route::post('/pedidos-compra/{pedidoCompra}/receber', [PedidoCompraController::class, 'receberEstoque'])->name('pedidos-compra.receber');

    Route::resource('fornecedores', FornecedorController::class)
        ->parameters(['fornecedores' => 'fornecedor']);

    Route::post('/pedidos-compra/{pedido}/itens', [ItemPedidoCompraController::class, 'store'])->name('item-pedidos-compra.store');
    Route::delete('/item-pedidos-compra/{item}', [ItemPedidoCompraController::class, 'destroy'])->name('item-pedidos-compra.destroy');

    Route::resource('clientes', ClienteController::class);

    Route::resource('vendas', VendaController::class);
});
require __DIR__.'/auth.php';
