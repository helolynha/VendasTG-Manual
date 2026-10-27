<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pedidos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-primary-button class="mb-4" onclick="window.location.href='{{ route('pedidos.create') }}'">
                {{ __('Novo Pedido') }}
            </x-primary-button>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID Pedido</th>
                            <th>Data</th>
                            <th>Total</th>
                            <th>Cliente</th>
                            <th>Vendedor</th>
                            <th>Status</th>
                            <th>Ações</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pedidos as $pedido)
                            <tr>
                                <td>{{ $pedido->codigo }}</td>
                                <td>{{ $pedido->data ?? 'Não informado' }}</td>
                                <td>{{ $pedido->total ?? 'Não informado' }}</td>
                                <td>{{ $pedido->cliente->pessoa->nome ?? 'Não informado' }}</td>
                                <td> {{ $pedido->vendedor->pessoa->nome ?? 'Não informado' }} </td>
                                <td>{{ $pedido->status == 1 ? 'Cancelado' : ($pedido->status == 2 ? 'Confirmado' : ($pedido->status == 3 ? 'Arquivado' : 'Não informado')) }}</td>
                                <td>
                                    <a href="{{ route('pedidos.edit', $pedido->codigo) }}" class="btn btn-sm btn-info">Visualizar</a>
                                </td>
                                @if(auth()->user()->nivel == 'adm')
                                    <td>
                                        <a href="{{ route('pedidos.delete', $pedido->codigo) }}" class="btn btn-sm btn-info">Arquivar</a>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Nenhum pedido encontrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
