<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Routes;

use App\Models\Produto;
use App\Models\Categoria;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::with('categoria')->get();
        return view('produtos.index', compact('produtos'));
    }

    public function create()
    {
        $produto = new Produto();
        $categorias = Categoria::all();
        return view('produtos.create', compact(['produto', 'categorias']));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'descricao' => 'required|string',
            'preco' => 'required',
            'estoque' => 'required|int',
            'categoria_codigo' => 'required|int',
        ]);

        // Create a new Produto
        $produto = new Produto();
        $produto->descricao = $validatedData['descricao'];
        $produto->preco = $validatedData['preco'];
        $produto->estoque = $validatedData['estoque'];
        $produto->categoria_codigo = $validatedData['categoria_codigo'];
        $produto->status = 1; 
        $produto->save();

        return redirect()->route('produtos.index')->with('success', 'Produto criado com sucesso!');
    }

    public function edit($codigo)
    {
        $produto = Produto::findOrFail($codigo);
        $categorias = Categoria::all();
        return view('produtos.create', compact(['produto', 'categorias']));
    }

    public function update(Request $request, $codigo)
    {
        $request->validate([
            'descricao' => 'required|string',
            'preco' => 'required',
            'estoque' => 'required|int',
            'categoria_codigo' => 'required|int',
        ]);

        $produto = Produto::findOrFail($codigo);
        $produto->descricao = $request['descricao'];
        $produto->preco = $request['preco'];
        $produto->estoque = $request['estoque'];
        $produto->categoria_codigo = $request['categoria_codigo'];
        $produto->status = ($request['estoque'] == 0 && $request['status'] == 1) ? 2 : $request['status'];
        $produto->save();

        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso!');
    }

    public function delete($codigo)
    {
        $produto = Produto::findOrFail($codigo);
        $produto->status = 3;
        $produto->save();

        return redirect()->route('produtos.index')->with('success', 'Produto excluído com sucesso!');
    }

}
