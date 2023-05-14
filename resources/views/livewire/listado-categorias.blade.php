<div class="mt-12 flex flex-row overflow-auto">
        @foreach ($categorias as $categoria)
            <button wire:click="emitCategoria('{{ $categoria }}')"  class="mx-2 border font-mono p-2 text-xs border-black hover:bg-gray-800 hover:text-white">
                {{ ucfirst($categoria) }}
            </button>
        @endforeach
        <div class="ml-5" wire:loading wire:target="emitCategoria">
            <x-uiw-loading class="inline h-6 w-6" /> Cargando
        </div>
</div>
