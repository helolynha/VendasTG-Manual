<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    
    @if ($produto)
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Produto') }}
        </h2>

        <form method="POST" action="{{ route('produtos.update', $produto->codigo) }}">
            @csrf
            @method('PUT')

            
            <!-- Descrição -->
            <div>
                <x-input-label for="descricao" :value="__('Descricao')" />
                <x-text-input id="descricao" class="block mt-1 w-full" type="text" name="descricao" :value="$produto->descricao ?? old('descricao')" required autofocus />
                <x-input-error :messages="$errors->get('descricao')" class="mt-2" />
            </div>

            <!-- Preço -->
            <div class="mt-4">
                <x-input-label for="preco" :value="__('Preço')" />
                <x-text-input id="preco" class="block mt-1 w-full" type="number" step="0.01" name="preco" :value="$produto->preco ?? old('preco')" required />
                <x-input-error :messages="$errors->get('preco')" class="mt-2" />
            </div>

            <!-- Estoque -->
            <div class="mt-4">
                <x-input-label for="estoque" :value="__('Estoque')" />
                <x-text-input id="estoque" class="block mt-1 w-full" type="number" name="estoque" :value="$produto->estoque ?? old('estoque')" required />
                <x-input-error :messages="$errors->get('estoque')" class="mt-2" />
            </div>

            <!-- Categoria -->
            <div class="mt-4">
                <x-input-label for="categoria" :value="__('Categoria')" />
                <select id="categoria" name="categoria_codigo" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                    <option value="" disabled>Selecione uma categoria</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->codigo }}"
                        {{ (isset($produto) && $produto->categoria_codigo == $categoria->codigo) ? 'selected' : '' }}>
                        {{ $categoria->nome }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('categoria')" class="mt-2" />
            </div>

            <!-- Status -->
            <div class="mt-4">
                <x-input-label for="status" :value="__('Status')" />
                <select id="status" name="status" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                    <option value="1"
                      {{ (isset($produto) && ($produto->status == 1 || $produto->status == 2)) ? 'selected' : '' }}>
                      Ativo</option>
                      <option value="3"
                      {{ (isset($produto) && $produto->status == 3) ? 'selected' : '' }}>
                      Inativo</option>

                </select>
                <x-input-error :messages="$errors->get('categoria')" class="mt-2" />
            </div>

            <x-primary-button class="mt-4">
                {{ __('Salvar') }}
            </x-primary-button>
        </form>
    @else
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Novo Produto') }}   
        </h2>
        
        <form method="POST" action="{{ route('produtos.store') }}">
            @csrf

            <!-- Descrição -->
            <div>
                <x-input-label for="descricao" :value="__('Descricao')" />
                <x-text-input id="descricao" class="block mt-1 w-full" type="text" name="descricao" :value="old('descricao')" required autofocus />
                <x-input-error :messages="$errors->get('descricao')" class="mt-2" />
            </div>

            <!-- Preço -->
            <div class="mt-4">
                <x-input-label for="preco" :value="__('Preço')" />
                <x-text-input id="preco" class="block mt-1 w-full" type="number" step="0.01" name="preco" :value="old('preco')" required />
                <x-input-error :messages="$errors->get('preco')" class="mt-2" />
            </div>

            <!-- Estoque -->
            <div class="mt-4">
                <x-input-label for="estoque" :value="__('Estoque')" />
                <x-text-input id="estoque" class="block mt-1 w-full" type="number" name="estoque" :value="old('estoque')" required />
                <x-input-error :messages="$errors->get('estoque')" class="mt-2" />
            </div>

            <!-- Categoria -->
            <div class="mt-4">
                <x-input-label for="categoria" :value="__('Categoria')" />
                <select id="categoria" name="categoria_codigo" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                    <option value="" disabled selected>Selecione uma categoria</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->codigo }}">{{ $categoria->nome }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('categoria')" class="mt-2" />
            </div>

            <x-primary-button class="mt-4">
                {{ __('Salvar') }}
            </x-primary-button>
        </form>
    @endif
</x-guest-layout>
