<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pessoa;

class PessoaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:pessoas,cpf',
            'status' => 'required|boolean',
        ]);

        $pessoa = Pessoa::create($request->all());
        return $pessoa;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pessoa = Pessoa::findOrFail($id);
        return $pessoa;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nome' => 'sometimes|required|string|max:255',
            'cpf' => 'sometimes|required|string|max:14|unique:pessoas,cpf,' . $id,
            'status' => 'sometimes|required|boolean',
        ]);

        $pessoa = Pessoa::findOrFail($id);
        $pessoa->update($request->all());
        return $pessoa;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pessoa = Pessoa::findOrFail($id);
        $pessoa->update(['status' => 2]);
        return response()->json(['message' => 'Pessoa desativada com sucesso.'], 200);
    }
}
