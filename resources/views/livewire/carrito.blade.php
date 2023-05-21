<div>
    <div class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
        <x-tni-cart-o class="h-6 w-6 text-white"/>
        <button class="ml-2" wire:click="verCarrito">
            {{-- LogoCarrito --}}   
            Carrito | 
            {{ $cantidadProductos }}
        </button>

    </div>
    
<x-dialog-modal wire:model="crearModal" maxWidth="6xl">

        <x-slot name="title">
            Carrito
        </x-slot>

        <x-slot name="content">
            
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Imagen</span>
                </th>
                <th scope="col" class="px-6 py-3">
                    Producto
                </th>
                <th scope="col" class="px-6 py-3">
                    Cantidad
                </th>
                <th scope="col" class="px-6 py-3">
                    Precio
                </th>
                <th scope="col" class="px-6 py-3">
                    Precio Total
                </th>
                <th scope="col" class="px-6 py-3">
                    
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($productosCarrito as $producto)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="w-32 p-4">
                    <img src="{{ $producto->imagen ? asset('storage/'. $producto->imagen) : 'https://random.imagecdn.app/500/500' }}" alt="Imagen de {{ $producto->nombre }}">
                </td>
                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                    {{ $producto->nombre }}
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center space-x-3">
                        <button wire:click.defer="disminuir({{ $loop->index }})" class="inline-flex items-center p-1 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" type="button">
                            <span class="sr-only">Quantity button</span>
                            <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                        </button>
                        <div>
                            <input wire:model.defer="arrayCantidad.{{ $loop->index }}" type="number" id="first_product" class="bg-gray-50 w-14 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-2.5 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </div>
                        <button wire:click.defer="aumentar({{ $loop->index }})" class="inline-flex items-center p-1 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" type="button">
                            <span class="sr-only">Quantity button</span>
                            <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                        </button>
                    </div>
                </td>
                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                   $ {{ $producto->precio }}
                </td>
                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                   $ {{ $producto->precio * $arrayCantidad[$loop->index] }}
                </td>
                <td class="px-6 py-4">
                    <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline" wire:click="eliminarProductoCarrito({{ $producto->id }})">Eliminar</a>
                </td>
            </tr>

            @endforeach
            
        </tbody>
    </table>
</div>


        <div id="popup-modal" tabindex="-1" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 hidden p-4 overflow-x-hidden overflow-y-auto">
            <div class="relative w-full h-full max-w-md md:h-auto">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="popup-modal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    
            <div class="p-6 text-center">
                <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">¿Deseas crear el pedido?, lo revisaremos y te mantendremos actualizado de los cambios.</h3>
                <button data-modal-hide="popup-modal" type="button" class="text-white bg-sky-600 hover:bg-sky-800 focus:ring-4 focus:outline-none focus:ring-sky-300 dark:focus:ring-sky-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2" wire:click="$emit('crearPedido')">
                    Crear
                </button>
                <button data-modal-hide="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancelar</button>
            </div>
                    
                </div>
            </div>
        </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="cerrarModalVer" wire:loading.attr="disabled" data-modal-hide="popup-modal">
                Cerrar
            </x-secondary-button>
            <x-button class=" bg-gray-700 text-white hover:bg-gray-500 ml-5" wire:loading.attr="disabled" data-modal-target="popup-modal" data-modal-toggle="popup-modal">
                Crear Pedido
            </x-button>
        </x-slot>
    </x-dialog-modal>

    @push('scripts')
    <script>
        Livewire.on('crearPedido', async () => {
            let productosId = @this.productosId;
            let productosCantidad = @this.arrayCantidad;

            console.log(productosId)
            console.log(productosCantidad)
            let datosPedido = {};
            console.log('id',@js(Auth::id()))
            datosPedido.user_id = @js(Auth::id());
            datosPedido.tipo = 'tienda';
            datosPedido.productos_id = productosId;
            let objProductos = {};
            for(let i = 0; i < productosId.length; i++){
                objProductos[productosId[i]] = {};
                objProductos[productosId[i]].cantidad = productosCantidad[i];
            }
            datosPedido.productos_array = objProductos;
            console.log(datosPedido);

            let res = await fetch('/api/ordenes',{
                method: 'POST',
                headers:{
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(datosPedido),
            })

            const respuestaJson = await res.json()
            console.log(respuestaJson);
            if(respuestaJson.data){
                const toastNoti = document.getElementById('toastNoti')
                const event = new CustomEvent("toast", { 
                    detail:  {
                        title: 'Orden Creada',
                        message: 'Puedes revisarla en el apartado de ordenes',
                        success: true
                    },
                    bubbles:true
                });
                toastNoti.dispatchEvent(event);
                Livewire.emit('limpiarCarrito')
            }else{
                const toastNoti = document.getElementById('toastNoti')
                const event = new CustomEvent("toast", { 
                    detail:  {
                        title: 'Error',
                        message: 'No hay productos en el carrito',
                        success: false
                    },
                    bubbles:true
                });
                toastNoti.dispatchEvent(event);
            }



        })
    </script>
    @endpush
</div>
