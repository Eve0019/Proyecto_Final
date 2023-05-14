<div>
    {{-- <x-button wire:click="$toggle('crearModal')">Agregar producto</x-button> --}}
    <x-dialog-modal wire:model="crearModal">

        <x-slot name="title">
            {{ $producto->nombre }}
        </x-slot>

        <x-slot name="content">

            <div class="container mx-auto px-6">
                <div class="md:flex md:items-center">
                    <div class="w-full h-64 md:w-1/2 lg:h-96 ">
                        <img class="h-full w-full rounded-md object-cover max-w-lg mx-auto"
                            alt="Imagen de {{ $producto->nombre }}"
                            src="{{ $producto->imagen ? asset('storage/' . $producto->imagen) : 'https://random.imagecdn.app/500/500' }}" />
                    </div>
                    <div class="w-full max-w-lg mx-auto mt-5 md:ml-8 md:mt-0 md:w-1/2 lg:py-12">
                        <h3 class="text-3xl leading-7 mb-2 font-bold uppercase lg:text-5xl">
                            {{ $producto->nombre }}
                        </h3>
                        <span class="text-2xl leading-7 font-bold mt-3">
                            $ {{ $producto->precio }}
                        </span>
                        <span class="text-1xl leading-7 font-bold mt-3 block">
                            Pedidos: {{ $producto->pedidos }}
                        </span>
                        @role('user')
                        <div class="mt-8">
                            <label class="text-1xl" htmlFor="count">
                                Count:
                            </label>
                            <div class="flex items-center mt-4">
                                <button wire:click="aumentar"
                                    class="border border-black w-36 h-12 text-gray-500 focus:outline-none focus:text-gray-600">
                                    <div class="flex justify-center">
                                        {{-- Add Icon --}}
                                        <x-heroicon-o-plus class="w-6 h-6"/>
                                    </div>
                                </button>
                                <span class="text-2xl mx-2" ref={countRef}>
                                    {{ $cantidad }}
                                </span>
                                <button wire:click="disminuir"
                                    class="border border-black w-36 h-12 text-gray-500 focus:outline-none focus:text-gray-600">
                                    <div class="flex justify-center">
                                        {{-- Minus Icon --}}
                                        <x-heroicon-o-minus class="w-6 h-6"/>
                                    </div>
                                </button>
                            </div>
                        </div>
                        
                        @endrole
                        <div class="mt-12 flex flex-row justify-between ">
                            @role('user')
                            <button class="border p-2 mb-8 border-black shadow-offset-lime w-2/3 font-bold" wire:click="agregarCarrito">    
                                Agregar al Carrito
                            </button>
                            @else
                                <button class="border p-2 mb-8 rounded-md border-red bg-red-400 shadow-offset-lime w-2/3 font-bold" wire:click="eliminarProducto">
                                    Eliminar Producto
                                </button>
                            @endrole
                        </div>
                    </div>
                </div>
                <div class="mt-16 md:w-2/3">
                    <h3 class="text-gray-600 text-2xl font-medium">Descripción</h3>
                    {{ $producto->descripcion }}
                </div>
            </div>

            
            {{-- <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative" role="alert"
                x-data="{ show: @entangle('flashMessage').defer }" x-show="show">
                <strong class="font-bold">Producto agregado correctamente</strong>
                <span class="block sm:inline">Something seriously bad happened.</span>
                <span @click="show = false" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-blue-500" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <title>Close</title>
                        <path
                            d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                    </svg>
                </span>
            </div> --}}

        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="cerrarModalVer" wire:loading.attr="disabled">
                Cerrar
            </x-secondary-button>

            {{-- <x-button
                class="ml-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                wire:click="submit" wire:loading.attr="disabled">
                Crear
            </x-button> --}}
        </x-slot>
    </x-dialog-modal>

</div>
