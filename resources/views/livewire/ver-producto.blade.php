<div>
    {{-- <x-button wire:click="$toggle('crearModal')">Agregar producto</x-button> --}}
    <x-dialog-modal wire:model="crearModal" maxWidth="2xl">

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
                                Cantidad:
                            </label>
                            <div x-data="{
                                cantidad: @entangle('cantidad').defer,
                                aumentar(){
                                    if(this.cantidad < 20)
                                        this.cantidad++
                                },
                                disminuir(){
                                    if(this.cantidad > 1){
                                        this.cantidad--;
                                    }
                                }

                            }" class="flex items-center mt-4">
                                <button @click="disminuir"
                                    class="border border-black w-36 h-12 text-gray-500 focus:outline-none focus:text-gray-600">
                                    <div class="flex justify-center">
                                        {{-- Minus Icon --}}
                                        <x-heroicon-o-minus class="w-6 h-6"/>
                                    </div>
                                </button>
                                <span class="text-2xl mx-2" ref={countRef} x-text="cantidad"></span>
                                <button @click="aumentar"
                                    class="border border-black w-36 h-12 text-gray-500 focus:outline-none focus:text-gray-600">
                                    <div class="flex justify-center">
                                        {{-- Add Icon --}}
                                        <x-heroicon-o-plus class="w-6 h-6"/>
                                    </div>
                                </button>
                            </div>
                        </div>
                        
                        @endrole
                        <div class="mt-12 flex flex-row justify-between ">
                            @role('user')
                            <button class="border p-2 mb-8 border-black shadow-offset-lime w-2/3 font-bold hover:bg-sky-500" wire:click="agregarCarrito">    
                                Agregar al Carrito
                            </button>
                            @else

                            <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="block text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" type="button">
                                Eliminar producto
                            </button>
                              
                            <div id="popup-modal" tabindex="-1" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 hidden p-4 overflow-x-hidden overflow-y-auto">
                                  <div class="relative w-full h-full max-w-md md:h-auto">
                                      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                          <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="popup-modal">
                                              <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                              <span class="sr-only">Close modal</span>
                                          </button>
                                          <div class="p-6 text-center">
                                              <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                              <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">¿Estás seguro que deseas eliminar este producto?, la información no podrá ser recuperada.</h3>
                                              <button data-modal-hide="popup-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2" wire:click="eliminarProducto">
                                                  Borrar producto
                                              </button>
                                              <button data-modal-hide="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancelar</button>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                            @endrole
                        </div>
                    </div>
                </div>
                <div class="mt-6 md:w-2/3">
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
            @role('user')
            <x-secondary-button wire:click="cerrarModalVer" wire:loading.attr="disabled">
                Cerrar
            </x-secondary-button>
            @else
            <x-secondary-button data-modal-hide="popup-modal" wire:click="cerrarModalVer" wire:loading.attr="disabled">
                Cerrar
            </x-secondary-button>

            @endrole

            {{-- <x-button
                class="ml-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                wire:click="submit" wire:loading.attr="disabled">
                Crear
            </x-button> --}}
        </x-slot>
        
    </x-dialog-modal>

</div>
