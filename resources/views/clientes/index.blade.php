<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clientes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-primary-button class="mb-4" onclick="window.location.href='{{ route('clientes.create') }}'">
                {{ __('Novo Cliente') }}
            </x-primary-button>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID Pessoa</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Nível de Fidelidade</th>
                            <th>Status</th>
                            @if(auth()->user()->nivel == 'admin')
                                <th>Ações</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($clientes as $cliente)
                            <tr>
                                <td>{{ $cliente->pessoa_codigo }}</td>
                                <td>{{ $cliente->pessoa->nome ?? 'Não informado' }}</td>
                                <td>{{ $cliente->pessoa->cpf ?? 'Não informado' }}</td>
                                <td>{{ $cliente->nivel_fidelidade == 1 ? 'Bronze' : ($cliente->nivel_fidelidade == 2 ? 'Prata' : ($cliente->nivel_fidelidade == 3 ? 'Ouro' : 'Não informado')) }}</td>
                                <td>{{ $cliente->pessoa->status == 1 ? 'Ativo' : ($cliente->pessoa->status == 2 ? 'Inativo' : 'Não informado') }}</td>
                                @if(auth()->user()->nivel == 'admin')
                                    <td>
                                        <a href="{{ route('clientes.edit', $cliente->pessoa_codigo) }}" class="btn btn-sm btn-info">Editar</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('clientes.delete', $cliente->pessoa_codigo) }}" class="btn btn-sm btn-info">Excluir</a>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Nenhum cliente encontrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
