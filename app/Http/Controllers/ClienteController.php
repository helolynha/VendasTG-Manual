<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Routes;

use App\Models\Cliente;
use App\Models\Pessoa;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::with('pessoa')->get();
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        $cliente = new Cliente();
        return view('clientes.create', compact('cliente'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:pessoas,cpf',
        ]);

        // Create a new Pessoa
        $pessoa = new Pessoa();
        $pessoa->nome = $validatedData['nome'];
        $pessoa->cpf = $validatedData['cpf'];
        $pessoa->status = 1; 
        $pessoa->save();

        // Create a new Cliente associated with the Pessoa
        $cliente = new Cliente();
        $cliente->pessoa_codigo = $pessoa->codigo;
        $cliente->nivel_fidelidade = 1;
        $cliente->save();

        return redirect()->route('clientes.index')->with('success', 'Cliente criado com sucesso!');
    }

    public function edit($pessoa_codigo)
    {
        $cliente = Cliente::with('pessoa')->where('pessoa_codigo', $pessoa_codigo)->firstOrFail();
        return view('clientes.create', compact('cliente'));
    }

    public function update(Request $request, $pessoa_codigo)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:pessoas,cpf,' . $pessoa_codigo . ',codigo',
        ]);

        $pessoa = Pessoa::findOrFail($pessoa_codigo);
        $pessoa->nome = $request->nome;
        $pessoa->cpf = $request->cpf;
        $pessoa->save();

        return redirect()->route('clientes.index')->with('success', 'Cliente atualizado com sucesso!');
    }

    public function delete($pessoa_codigo)
    {
        $pessoa = Pessoa::findOrFail($pessoa_codigo);
        $pessoa->status = 2;
        $pessoa->save();

        return redirect()->route('clientes.index')->with('success', 'Cliente excluído com sucesso!');
    }

}
