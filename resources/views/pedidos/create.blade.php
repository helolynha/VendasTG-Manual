<x-app-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    
    @if ($pedido && $pedido->codigo)
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Visualizar Pedido') }}
        </h2>

        <br>
        <form method="POST" action="{{ route('pedidos.update', $pedido->codigo) }}">
            @csrf
            @method('PUT')

            <!-- Vendedor -->
            <div>
                <x-input-label for="vendedor" :value="__('Vendedor')" />
                <select id="vendedor" name="vendedor" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                    <option value="auth()->user()->vendedor->pessoa->codigo" selected>{{auth()->user()->vendedor->pessoa->nome}}</option>
                </select>
                <x-input-error :messages="$errors->get('vendedor')" class="mt-2" />
            </div>

            <!-- Cliente -->
            <div class="mt-4">
                <x-input-label for="cliente" :value="__('Cliente')" />
                <select id="cliente" name="cliente" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required disabled>
                    <option value="" disabled selected>Selecione um cliente</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->pessoa->codigo }}"
                        {{ (isset($pedido) && $pedido->cliente_codigo == $cliente->pessoa->codigo) ? 'selected' : '' }}>
                        {{ $cliente->pessoa->nome }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('cliente')" class="mt-2" />
            </div>
            <br>
            <br>

            <div id="produtos-pedido">
                @foreach ($itens_pedidos as $item_pedido)
                    <fieldset class="border p-3 rounded-3 mb-4 produto-fieldset" id="produtos-fieldset">
                        <h2 class="font-semibold text-gray-800 leading-tight">
                            {{ __('Produto') }}   
                        </h2>
                        <div class="mt-4">
                            <x-input-label for="item_pedido[codigo]" :value="__('Produto')" />
                            <select id="item_pedido[codigo]" name="item_pedido[codigo]"
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm produto-select" required disabled>
                                <option value="" disabled selected>Selecione um produto</option>
                                @foreach($produtos as $produto)
                                    <option value="{{ $produto->codigo }}"
                                    {{ (isset($item_pedido) && $item_pedido->produto_codigo == $produto->codigo) ? 'selected' : '' }}>
                                    {{ $produto->descricao }} - R${{ $produto->preco }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('produtos[0][codigo]')" class="mt-2" />
                        
                            <div class="mt-4">
                                <x-input-label for="item_pedido->qtd_vendida" :value="__('Quantidade Vendida')" />
                                <x-text-input id="item_pedido->qtd_vendida" class="block mt-1 w-full qtd-vendida" type="number" min="0" 
                                    name="item_pedido->qtd_vendida" :value="$item_pedido->qtd_vendida ?? old('qtd_vendida')" required disabled/>
                                <x-input-error :messages="$errors->get('qtd_vendida')" class="mt-2" />
                            </div>
                        </div>
                    </fieldset>
                @endforeach
            </div>
            <!-- <x-secondary-button class="mt-4" onclick="adicionarProduto()">
                {{ __('Adicionar Produto') }}
            </x-secondary-button> -->

            <!-- Total -->
            <div class="mt-4">
                <x-input-label for="total" :value="__('Total')" />
                <x-text-input id="total" class="block mt-1 w-full" type="number" step="0.01" name="total" :value="$pedido->total ?? old('total')" required disabled/>
                <x-input-error :messages="$errors->get('total')" class="mt-2" />
            </div>
            @if(auth()->user()->nivel == 'adm')
                <!-- Status -->
                <div class="mt-4">
                    <x-input-label for="status" :value="__('Status')" />
                    <select id="status" name="status" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                        <option value="1"
                        {{ (isset($pedido) && $pedido->status == 1) ? 'selected' : '' }}>
                        Cancelado</option>
                        <option value="2"
                        {{ (isset($pedido) && $pedido->status == 2) ? 'selected' : '' }}>
                        Confirmado</option>
                        <option value="3"
                        {{ (isset($pedido) && $pedido->status == 3) ? 'selected' : '' }}>
                        Arquivado</option>

                    </select>
                    <x-input-error :messages="$errors->get('categoria')" class="mt-2" />
                </div>
                
                <x-primary-button class="mt-4">
                    {{ __('Salvar') }}
                </x-primary-button>
            @endif
        </form>
    @else
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Novo Pedido') }}   
        </h2>
        
        <br>
        <form method="POST" action="{{ route('pedidos.store') }}">
            @csrf
            <!-- Vendedor -->
            <div>
                <x-input-label for="vendedor" :value="__('Vendedor')" />
                <select id="vendedor" name="vendedor" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                    <option value="auth()->user()->vendedor->pessoa->codigo" selected>{{auth()->user()->vendedor->pessoa->nome}}</option>
                </select>
                <x-input-error :messages="$errors->get('vendedor')" class="mt-2" />
            </div>

            <!-- Cliente -->
            <div class="mt-4">
                <x-input-label for="cliente" :value="__('Cliente')" />
                <select id="cliente" name="cliente" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                    <option value="" disabled selected>Selecione um cliente</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->pessoa->codigo }}">{{ $cliente->pessoa->nome }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('cliente')" class="mt-2" />
            </div>
            <br>
            <br>

            <div id="produtos-pedido">
                <fieldset class="border p-3 rounded-3 mb-4 produto-fieldset" id="produtos-fieldset">
                    <h2 class="font-semibold text-gray-800 leading-tight">
                        {{ __('Produto') }}   
                    </h2>
                    <div type="button" onclick="removerProduto(this)"> Remover Produto</div>
                    <div class="mt-4">
                        <x-input-label for="produtos[0][codigo]" :value="__('Produto')" />
                        <select id="produtos[0][codigo]" name="produtos[0][codigo]"
                            class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm produto-select" required
                            onchange="atualizarProduto(this)">
                            <option value="" disabled selected>Selecione um produto</option>
                            @foreach($produtos as $produto)
                                <option value="{{ $produto->codigo }}">{{ $produto->descricao }} - R${{ $produto->preco }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('produtos[0][codigo]')" class="mt-2" />
                    
                        <div class="mt-4">
                            <x-input-label for="qtd_vendida" :value="__('Quantidade Vendida')" />
                            <x-text-input id="produtos[0][qtd_vendida]" class="block mt-1 w-full qtd-vendida" type="number" min="0" 
                                name="produtos[0][qtd_vendida]" :value="$produto->qtd_vendida ?? old('qtd_vendida')" required onchange="calcularTotal()"/>
                            <x-input-error :messages="$errors->get('qtd_vendida')" class="mt-2" />
                        </div>
                    </div>
                </fieldset>
            </div>
            <x-secondary-button class="mt-4" onclick="adicionarProduto()">
                {{ __('Adicionar Produto') }}
            </x-secondary-button>

            <!-- Total -->
            <div class="mt-4">
                <x-input-label for="total" :value="__('Total')" />
                <x-text-input id="total" class="block mt-1 w-full" type="number" step="0.01" name="total" :value="old('total')" required/>
                <x-input-error :messages="$errors->get('total')" class="mt-2" />
            </div>

            <x-primary-button class="mt-4">
                {{ __('Salvar') }}
            </x-primary-button>
        </form>
    @endif
</x-app-layout>
<script>
    let rowIndex = 0;
    let totalPedido = 0;

    function adicionarProduto() {
        rowIndex++;
        const listaProdutos = document.querySelector('#produtos-pedido');
        const fieldset = listaProdutos.querySelector('#produtos-fieldset')
        const novoProduto = fieldset.cloneNode(true);

        atualizarIndice(novoProduto, rowIndex);

        novoProduto.querySelectorAll('input, select').forEach(element => {
            element.value = '';
        });

        listaProdutos.appendChild(novoProduto);
    }

    function atualizarIndice(produto, indice) {
        // Atualizar os ids dos inputs com o novo índice para o Laravel mapear como array
        produto.querySelectorAll('input, select').forEach(element => {
            let id = element.getAttribute('id');
            let name = element.getAttribute('name');
            if (id) {
                element.setAttribute('id', id.replace(/\[\d+\]/, `[${indice}]`));
            }
            if (name) {
                element.setAttribute('name', name.replace(/\[\d+\]/, `[${indice}]`));
            }
        });
    }

    function removerProduto(e) {
        var linhas = document.querySelectorAll('.produto-fieldset');
        if (linhas.length > 1) {
            e.closest('.produto-fieldset').remove();
            
            linhas = document.querySelectorAll('.produto-fieldset');
            
            rowIndex = linhas.length - 1;
    
            linhas.forEach(function(produto, indice) {
                atualizarIndice(produto, indice);
            });
            
            calcularTotal();

        } else {
            alert('O pedido precisa conter pelo menos um item.');
        }
    }

    function calcularTotal() {
        let totalPedido = 0;
        var produtos = @json($produtos);
        var linhas = document.querySelectorAll('.produto-fieldset');
        for (let i = 0; i < linhas.length; i++) {
            codigo_produto = document.getElementById('produtos['+ i + '][codigo]').value;
            if(codigo_produto != "") {
                valor_produto = produtos.filter((p) => {
                    return p.codigo == codigo_produto;
                })[0]['preco'];
                qtd_produto = document.getElementById('produtos['+ i + '][qtd_vendida]').value ?? 0;
                totalPedido += valor_produto * qtd_produto;
            }
        }
       document.getElementById('total').value = totalPedido;
    }

    function atualizarProduto (prod) {
        //atualiza o valor máximo do qtd_vendida
        var produtos = @json($produtos);
        estoque_produto = produtos.filter((p) => {
            return p.codigo == prod.value;
        })[0]['estoque'];

        let id = prod.getAttribute('id');
        qtd_vendida = document.getElementById(id.replace(/\[codigo\]$/, "[qtd_vendida]"));
        qtd_vendida.setAttribute('max', estoque_produto);

        //calcula o valor total do pedido
        calcularTotal();
    }

</script>
