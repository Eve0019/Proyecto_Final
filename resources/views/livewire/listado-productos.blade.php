<div>
    <div class="grid grid-cols-2 w-full gap-2 ml-auto mr-auto mt-8 lg:grid-cols-3 xl:grid-cols-4 lg:gap-8 border ">
        {{-- <ProductCard key={product._id} {...product} /> --}}
        @foreach ($productos as $producto)
        <div class="w-full max-w-sm mx-auto overflow-hidden border border-black">
            <div class="h-30 w-full justify-end object-contain">
                <a href="/LinkAProducto">
                    <img alt="Imagen de {{ $producto->nombre }}" src="{{ $producto->imagen ? asset('storage/'. $producto->imagen) : 'https://random.imagecdn.app/500/500' }}">
                </a>
                <div class="flex justify-between mt-5 mx-2">
                    <x-button wire:click="mostrarProducto({{ $producto->id }})">
                        Detalles
                    </x-button>
                    <x-button wire:click="$emit('editarProducto',{{ $producto->id }})" class=" bg-yellow-500">
                        Editar
                    </x-button>
                </div>
            </div>
            {{-- <div class="mb-4 lg:mt-48 mt-12 lg:pt-8"> --}}
            <div class="mb-4 lg:mt-6 mt-3 lg:pt-4">
                <h3 class="ml-2 text-lg font-bold uppercase"> {{ $producto->nombre }}</h3>
                <div class="flex flex-col">
                    <span class="ml-2 text-lg leading-7">
                        {{ $producto->precio }}
                    </span>
                    <span class="ml-2 text-lg leading-7">
                        {{ $producto->categoria }}
                    </span>
                </div>
            </div>
        </div>
            
        @endforeach
    </div>
    <div class="pt-8">
        {{$productos->links()}}
    </div>
</div>

