<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Entrar no Sistema</h2>

    @if($errors->any())
        <div style="color: red;">
            <ul>
                @foreach($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('login.enviar') }}" method="POST">
        @csrf
        <div>
            <label>E-mail:</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div>
            <label>Senha:</label>
            <input type="password" name="senha" required>
        </div>

        <button type="submit">Entrar</button>
    </form>
</body>
</html>