<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    
    @if ($cliente && $cliente->pessoa)
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Cliente') }}
        </h2>

        <form method="POST" action="{{ route('clientes.update', $cliente->pessoa_codigo) }}">
            @csrf
            @method('PUT')

            <!-- Nome -->
            <div>
                <x-input-label for="nome" :value="__('Nome')" />
                <x-text-input id="nome" class="block mt-1 w-full" type="text" name="nome" :value="$cliente->pessoa->nome ?? old('nome')" required autofocus />
                <x-input-error :messages="$errors->get('nome')" class="mt-2" />
            </div>

            <!-- CPF -->
            <div class="mt-4">
                <x-input-label for="cpf" :value="__('CPF')" />
                <x-text-input id="cpf" class="block mt-1 w-full" type="text" name="cpf" :value="$cliente->pessoa->cpf ?? old('cpf')" required />
                <x-input-error :messages="$errors->get('cpf')" class="mt-2" />
            </div>

            <x-primary-button class="mt-4">
                {{ __('Salvar') }}
            </x-primary-button>
        </form>
    @else
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Novo Cliente') }}   
        </h2>
        
        <form method="POST" action="{{ route('clientes.store') }}">
            @csrf

            <!-- Nome -->
            <div>
                <x-input-label for="nome" :value="__('Nome')" />
                <x-text-input id="nome" class="block mt-1 w-full" type="text" name="nome" :value="old('nome')" required autofocus />
                <x-input-error :messages="$errors->get('nome')" class="mt-2" />
            </div>

            <!-- CPF -->
            <div class="mt-4">
                <x-input-label for="cpf" :value="__('CPF')" />
                <x-text-input id="cpf" class="block mt-1 w-full" type="text" name="cpf" :value="old('cpf')" required />
                <x-input-error :messages="$errors->get('cpf')" class="mt-2" />
            </div>

            <x-primary-button class="mt-4">
                {{ __('Salvar') }}
            </x-primary-button>
        </form>
    @endif
</x-guest-layout>
