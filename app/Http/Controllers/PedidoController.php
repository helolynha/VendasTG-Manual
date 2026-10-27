<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Routes;

use App\Models\Produto;
use App\Models\Pedido;
use App\Models\Cliente;
use App\Models\Item_Pedido;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::with(['cliente','vendedor'])->orderBy('codigo', 'desc')->get();
        return view('pedidos.index', compact('pedidos'));
    }

    public function create()
    {
        $pedido = new Pedido();
        $produtos = Produto::where('estoque', '>', 0)->where('status', '!=', 3)->get();
        $clientes = Cliente::all();
        return view('pedidos.create', compact(['pedido', 'produtos', 'clientes']));
    }

    public function store(Request $request)
    {
        $dados = $request->all();
        
        $pedido = new Pedido();
        $pedido->vendedor_codigo = auth()->user()->vendedor->pessoa_codigo;
        $pedido->cliente_codigo = $dados['cliente'];
        $pedido->data = now()->format('Ymd H:i:s');
        $pedido->total = $dados['total'];
        $pedido->status = 2;
        
        $pedido->save();

        foreach($dados['produtos'] as $produto) {
            $prod = Produto::find($produto['codigo']);

            $item_pedido = new Item_Pedido([
                'pedido_codigo' => $pedido->codigo,
                'produto_codigo' => (int) $produto['codigo'],
                'qtd_vendida' => $produto['qtd_vendida'],
                'preco_unitario' => $prod->preco
            ]);

            $item_pedido->save();
            $prod->estoque -= $produto['qtd_vendida'];
            if ($prod->estoque == 0) { $prod->status = 2;}
            $prod->save();

        }

        return redirect()->route('pedidos.index')->with('success', 'Produto criado com sucesso!');
    }

    public function edit($codigo)
    {
        $pedido = Pedido::findOrFail($codigo);
        $produtos = Produto::all();
        $clientes = Cliente::all();
        $itens_pedidos = Item_Pedido::where('pedido_codigo', $codigo)->get();

        return view('pedidos.create', compact(['pedido', 'produtos', 'clientes', 'itens_pedidos']));
    }

    public function update(Request $request, $codigo)
    {
        $request->validate([
            'status' => 'required|int',
        ]);

        $pedido = Pedido::findOrFail($codigo);
        $pedido->status = $request['status'];
        $pedido->save();

        return redirect()->route('pedidos.index')->with('success', 'Pedido atualizado com sucesso!');
    }

    public function delete($codigo)
    {
        $pedido = Pedido::findOrFail($codigo);
        $pedido->status = 3;
        $pedido->save();

        return redirect()->route('pedidos.index')->with('success', 'Pedido excluído com sucesso!');
    }

}
