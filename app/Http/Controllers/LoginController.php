<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Exibe o formulário de login
    public function exibirFormulario()
    {
        return view('auth.login');
    }

    // Processa a tentativa de login
    public function autenticar(Request $request)
    {
        $credenciais = $request->validate([
            'email' => ['required', 'email'],
            'senha' => ['required'],
        ]);

        // O Auth::attempt verifica o email e compara o hash da senha automaticamente
        if (Auth::attempt(['email' => $credenciais['email'], 'password' => $credenciais['senha']])) {
            $request->session()->regenerate();

            // Redireciona para a página interna do sistema (ex: dashboard)
            return redirect()->intended('/principal');
        }

        // Se falhar, retorna com erro
        return back()->withErrors([
            'email' => 'As credenciais informadas não conferem com nossos registros.',
        ])->onlyInput('email');
    }

    // Faz o logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
