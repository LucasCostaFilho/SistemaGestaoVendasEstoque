<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registrar Nova Venda') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900" 
                    x-data="venda(
                        {{ json_encode($clientePadrao) }},
                        {{ json_encode($variacoes) }}
                    )">

                    <div x-show="successMessage"
                        x-transition
                        class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-6" 
                        role="alert"
                        style="display: none;">
                        <span class="block sm:inline" x-text="successMessage"></span>
                        <button @click="successMessage = ''" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <form @submit.prevent="finalizarVenda()">
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        
                            <div class="lg:col-span-2">
                                <h3 class="text-lg font-semibold mb-4">Itens da Venda</h3>

                                <div class="relative" @click.away="focoNaBusca = false">
                                    <label for="busca" class="block font-medium text-sm text-gray-700">Buscar Produto (por SKU ou Nome)</label>
                                    <input type="text" id="busca" 
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" 
                                        placeholder="Digite para buscar..."
                                        x-model="termoBusca"
                                        @input.debounce.300ms="buscarProdutos()"
                                        @focus="focoNaBusca = true">
                                    
                                    <div x-show="focoNaBusca && termoBusca.length > 0" x-transition class="absolute z-10 w-full bg-white border rounded-md shadow-lg mt-1 max-h-60 overflow-y-auto" style="display: none;">
                                        <ul>
                                            <template x-for="resultado in resultadosBusca" :key="resultado.id">
                                                <li @click="adicionarAoCarrinho(resultado)" class="px-4 py-3 hover:bg-gray-100 cursor-pointer border-b">
                                                    <div class="font-semibold" x-text="resultado.produto.nome + ' (SKU: ' + resultado.sku + ')'"></div>
                                                    <div class="text-sm text-gray-600" x-text="'Estoque: ' + resultado.estoque_atual + ' | Preço: ' + formatarDinheiro(resultado.preco)"></div>
                                                </li>
                                            </template>
                                            <template x-if="resultadosBusca.length === 0 && termoBusca.length > 0">
                                                <li class="px-4 py-3 text-gray-500">Nenhum produto encontrado.</li>
                                            </template>
                                        </ul>
                                    </div>
                                </div>

                                <div class="border rounded-lg overflow-hidden mt-6">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Produto</th>
                                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase w-32">Qtd.</th>
                                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Preço Unit.</th>
                                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            <template x-if="carrinho.length === 0">
                                                <tr><td colspan="5" class="py-4 text-center text-gray-500">Nenhum item adicionado.</td></tr>
                                            </template>
                                            <template x-for="item in carrinho" :key="item.id">
                                                <tr>
                                                    <td class="px-4 py-2">
                                                        <span class="font-semibold" x-text="item.produto.nome"></span>
                                                        <span class="text-sm text-gray-600" x-text="' (SKU: ' + item.sku + ')'"></span>
                                                    </td>
                                                    <td class="px-4 py-2">
                                                        <div class="flex items-center">
                                                            <button type="button" @click="if (item.quantidade > 1) item.quantidade--; else removerDoCarrinho(item.id)" class="w-6 h-6 text-lg font-semibold rounded-full bg-gray-200 hover:bg-gray-300 text-gray-700 flex items-center justify-center">-</button>
                                                            <input type="number" x-model.number="item.quantidade" @change="validarQuantidade(item)" class="w-16 text-center border-0 bg-transparent font-semibold focus:ring-0">
                                                            <button type="button" @click="if (item.quantidade < item.estoque_atual) item.quantidade++" class="w-6 h-6 text-lg font-semibold rounded-full bg-gray-200 hover:bg-gray-300 text-gray-700 flex items-center justify-center">+</button>
                                                        </div>
                                                    </td>
                                                    <td class="px-4 py-2" x-text="formatarDinheiro(item.preco)"></td>
                                                    <td class="px-4 py-2 font-semibold" x-text="formatarDinheiro(item.quantidade * item.preco)"></td>
                                                    <td class="px-4 py-2 text-center">
                                                        <button type="button" @click="removerDoCarrinho(item.id)" class="text-red-500 hover:text-red-700" title="Remover Item">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="lg:col-span-1">
                                <div class="bg-gray-50 p-4 rounded-lg shadow">
                                    <h3 class="text-lg font-semibold mb-4">Cliente</h3>
                                    <p x-text="clienteSelecionado.nome_completo"></p>
                                    <p class="text-sm text-gray-600" x-text="clienteSelecionado.cpf"></p>
                                    <button type="button" class="text-sm text-blue-500 hover:underline mt-2">Trocar Cliente</button>
                                </div>

                                <div class="bg-gray-50 p-4 rounded-lg shadow mt-6">
                                    <h3 class="text-lg font-semibold mb-4">Resumo</h3>
                                    <div class="flex justify-between"><span>Subtotal:</span> <span x-text="formatarDinheiro(totalCarrinho)"></span></div>
                                    <div class="flex justify-between font-bold text-xl mt-4 border-t pt-4"><span>TOTAL:</span> <span x-text="formatarDinheiro(totalCarrinho)"></span></div>
                                </div>

                                <div class="mt-6">
                                    <x-action-button type="submit" color="green" class="w-full justify-center py-3 text-base">
                                        <i class="fas fa-check-circle mr-2"></i>
                                        Finalizar Venda
                                    </x-action-button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    
    <script>
        function venda(clientePadrao, todasVariacoes) {
            return {
                clienteSelecionado: clientePadrao,
                variacoesDisponiveis: todasVariacoes,
                carrinho: [],
                termoBusca: '',
                resultadosBusca: [],
                focoNaBusca: false,
                successMessage: '',

                buscarProdutos() {
                    if (this.termoBusca.trim() === '') {
                        this.resultadosBusca = [];
                        return;
                    }
                    this.resultadosBusca = this.variacoesDisponiveis.filter(variacao => {
                        const termo = this.termoBusca.toLowerCase();
                        const nomeProduto = variacao.produto.nome.toLowerCase();
                        const sku = variacao.sku.toLowerCase();
                        return nomeProduto.includes(termo) || sku.includes(termo);
                    }).slice(0, 10);
                },

                adicionarAoCarrinho(variacao) {
                    const itemExistente = this.carrinho.find(item => item.id === variacao.id);
                    if (itemExistente) {
                        if (itemExistente.quantidade < variacao.estoque_atual) {
                            itemExistente.quantidade++;
                        } else {
                            alert('Estoque máximo para este item atingido!');
                        }
                    } else {
                        if (variacao.estoque_atual > 0) {
                            this.carrinho.push({ ...variacao, quantidade: 1 });
                        } else {
                            alert('Este item está sem estoque!');
                        }
                    }
                    this.termoBusca = '';
                    this.resultadosBusca = [];
                },

                removerDoCarrinho(itemId) {
                    this.carrinho = this.carrinho.filter(i => i.id !== itemId);
                },

                validarQuantidade(item) {
                    if (!item.quantidade || item.quantidade < 1) {
                        item.quantidade = 1;
                    }
                    if (item.quantidade > item.estoque_atual) {
                        item.quantidade = item.estoque_atual;
                        alert('Estoque máximo para este item atingido!');
                    }
                },
                
                finalizarVenda() {
                    // 1. MENSAGEM DE DEPURAÇÃO: Verifique se a função está sendo chamada.
                    console.log('Função finalizarVenda() foi chamada.');

                    // 2. VERIFICAÇÃO DE CARRINHO VAZIO: Impede o envio se não houver itens.
                    if (this.carrinho.length === 0) {
                        alert('O carrinho está vazio. Adicione pelo menos um item para finalizar a venda.');
                        console.log('Envio bloqueado: carrinho vazio.');
                        return; // Para a execução da função aqui
                    }

                    console.log('Carrinho validado. Enviando dados para o servidor...');
                    
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    const dadosVenda = {
                        cliente_id: this.clienteSelecionado.id,
                        itens: this.carrinho,
                    };

                    fetch('{{ route("vendas.store") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify(dadosVenda)
                    })
                    .then(response => {
                        if (!response.ok) {
                            return response.json().then(err => Promise.reject(err));
                        }
                        return response.json();
                    })
                    .then(result => {
                        // --- A LÓGICA DE SUCESSO CORRIGIDA ESTÁ AQUI ---
                        if (result.success) {
                            // 1. Define a mensagem de sucesso para ser exibida
                            this.successMessage = result.message;

                            // 2. Limpa o carrinho
                            this.carrinho = [];

                            // 3. Reseta o cliente para o padrão
                            this.clienteSelecionado = clientePadrao;

                            // 4. Limpa o campo de busca
                            this.termoBusca = '';

                            // 5. Faz a mensagem de sucesso desaparecer após 5 segundos
                            setTimeout(() => this.successMessage = '', 5000);
                        }
                    })
                    .catch(error => {
                        if (error.errors) {
                            const errorMessages = Object.values(error.errors).flat().join('\n');
                            alert('Erro de validação:\n' + errorMessages);
                        } else {
                            console.error('Erro:', error);
                            alert(error.message || 'Ocorreu um erro inesperado ao finalizar a venda.');
                        }
                    });
                },

                get totalCarrinho() {
                    if (!Array.isArray(this.carrinho)) return 0;
                    return this.carrinho.reduce((total, item) => {
                        const preco = parseFloat(item.preco) || 0;
                        const quantidade = parseInt(item.quantidade) || 0;
                        return total + (preco * quantidade);
                    }, 0);
                },

                formatarDinheiro(valor) {
                    if (isNaN(valor)) valor = 0;
                    return valor.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
                }
            }
        }
    </script>
</x-app-layout>