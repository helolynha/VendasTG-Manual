<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Produtos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-primary-button class="mb-4" onclick="window.location.href='{{ route('produtos.create') }}'">
                {{ __('Novo Produto') }}
            </x-primary-button>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID Produto</th>
                            <th>Descrição</th>
                            <th>Preço</th>
                            <th>Estoque</th>
                            <th>Categoria</th>
                            <th>Status</th>
                            @if(auth()->user()->nivel == 'adm')
                                <th>Ações</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($produtos as $produto)
                            <tr>
                                <td>{{ $produto->codigo }}</td>
                                <td>{{ $produto->descricao ?? 'Não informado' }}</td>
                                <td>{{ $produto->preco ?? 'Não informado' }}</td>
                                <td>{{ $produto->estoque ?? 'Não informado' }}</td>
                                <td> {{ $produto->categoria->nome}} </td>
                                <td>{{ $produto->status == 1 ? 'Ativo' : ($produto->status == 2 ? 'Em Falta' : ($produto->status == 3 ? 'Inativo' : 'Não informado')) }}</td>
                                @if(auth()->user()->nivel == 'adm')
                                    <td>
                                        <a href="{{ route('produtos.edit', $produto->codigo) }}" class="btn btn-sm btn-info">Editar</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('produtos.delete', $produto->codigo) }}" class="btn btn-sm btn-info">Excluir</a>                                        
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Nenhum produto encontrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
