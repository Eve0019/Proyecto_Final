<div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <main class="my-8">
                    <div class="container mx-auto px-6">

                        <div class="flex justify-between max-w-full">
                            <h3 class="text-gray-700 text-5xl font-bold mb-8">Tus Ordenes</h3>
                        </div>
                        {{-- {open ? <PopOver /> : null} --}}

                        {{--  <a onClick={clickHandler}>
                        </a> --}}


                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        @role('admin')
                                        <th scope="col" class="px-6 py-3">
                                            Usuario
                                        </th>
                                        @endrole
                                        <th scope="col" class="px-6 py-3">
                                            Estado
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Entrega
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Fecha estimada
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Total
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            <span class="sr-only">Opciones</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ordenes as $orden)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            @role('admin')
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $orden->user->name }}
                                            </th>
                                            @endrole
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $orden->estado }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $orden->tipo }}
                                            </td>
                                            <td class="px-6 py-4">
                                                @if ($orden->fecha == null)
                                                    Por determinar...
                                                @else
                                                    {{ $orden->fecha }}
                                                @endif
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $orden->total }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <button data-modal-target="modal{{ $orden->id }}"
                                                    data-modal-toggle="modal{{ $orden->id }}"
                                                    class="btn font-medium text-blue-600 hover:underline border outline-blue-500 p-2">Productos</button>
                                                <button data-modal-target="modalEliminar{{ $orden->id }}"
                                                    data-modal-toggle="modalEliminar{{ $orden->id }}"
                                                    class="btn font-medium text-red-600 hover:underline border outline-red-500 p-2">Cancelar
                                                    orden</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- Crear Modals --}}
                        @foreach ($ordenes as $orden)
                            <!-- Main modal -->
                            <div id="modal{{ $orden->id }}" data-modal-backdrop="static" tabindex="-1"
                                aria-hidden="true"
                                class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full bg-slate-500 bg-opacity-50">
                                <div class="relative w-full max-w-7xl max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <!-- Modal header -->
                                        <div
                                            class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                Productos del pedido
                                            </h3>
                                            <button type="button"
                                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-modal-hide="modal{{ $orden->id }}">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="p-6 space-y-6">
                                            {{-- Productos dedido --}}
                                            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                                                <table
                                                    class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                                    <thead
                                                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
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
                                                            {{-- <th scope="col" class="px-6 py-3">
                                  
                              </th> --}}
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($orden->productos as $producto)
                                                            <tr
                                                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                                <td class="w-32 p-4">
                                                                    <img src="{{ $producto->imagen ? asset('storage/' . $producto->imagen) : 'https://random.imagecdn.app/500/500' }}"
                                                                        alt="Imagen de {{ $producto->nombre }}">
                                                                </td>
                                                                <td
                                                                    class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                                                    {{ $producto->nombre }}
                                                                </td>
                                                                <td class="px-6 py-4">
                                                                    {{ $producto->pivot->cantidad }}
                                                                </td>
                                                                <td
                                                                    class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                                                    $ {{ $producto->precio }}
                                                                </td>
                                                                <td
                                                                    class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                                                    $
                                                                    {{ $producto->precio * $producto->pivot->cantidad }}
                                                                </td>
                                                                {{-- <td class="px-6 py-4">
                                  <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline" wire:click="eliminarProductoCarrito({{ $producto->id }})">Eliminar</a>
                              </td> --}}
                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                            </div>

                                            @role('admin')
                                            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                                                <form wire:submit.prevent="actualizarOrden({{ $orden->id }})">
                                                    <div class="mb-6">
                                                        <label for="estado" class="block mb-2 text-sm font-medium text-black-700">Estado actual: {{ $orden->estado }}</label>
                                                        <label for="estado" class="block mb-2 text-sm font-medium text-black-700">Nuevo estado:</label>
                                                        <select wire:model.defer="estado" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                                                            <option value="">Elegir...</option>
                                                            @foreach ($estadosOrden as $estado)
                                                            <option value="{{ $estado }}" {{ ($orden->estado == $estado) ? 'selected' : '' }}>{{ $estado }}</option>    
                                                            @endforeach
                                                        </select>
                                                        @error('estado')
                                                        <span class="error">{{ $message }}</span>
                                                        @enderror
                                                    </div>
    
                                                    <div class="mb-6">
                                                        <label for="name" class="block mb-2 text-sm font-medium text-black-700">Fecha actual: {{ $orden->fecha == null ? 'Sin fecha' : $orden->fecha }}</label>
                                                        <label for="name" class="block mb-2 text-sm font-medium text-black-700">Nueva fecha (escribela en el formato YYYY/MM/DD): </label>
                                                        <input type="text" wire:model.defer="fecha" placeholder="Nueva fecha" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                                                        @error('fecha')
                                                        <span class="error">{{ $message }}</span>
                                                        @enderror
                                                        {{-- <label for="date" class="block mb-2 text-sm font-medium text-black-700">Fecha estimada:</label>
                                                        
                                                        <input wire:model="date" id="date{{ $orden->id }}"
                                                            x-data
                                                            x-ref="input"
                                                            x-init="new Pikaday({ field: $refs.input })"
                                                            type="text"
                                                        >
                                    
                                                        @error('date')
                                                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{$message}}!</p>
                                                        @enderror --}}
                                                    </div>
                                                    <button class="text-white bg-slate-700 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Actualizar Pedido</button>
                                                </form>
                                                
                                            </div>

                                            @endrole

                                            {{-- !Productos dedido --}}
                                        </div>
                                        <!-- Modal footer -->
                                        <div
                                            class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                            {{-- <button data-modal-hide="modal{{ $orden->id }}" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I accept</button> --}}
                                            <button data-modal-hide="modal{{ $orden->id }}" type="button"
                                                class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="modalEliminar{{ $orden->id }}" tabindex="-1"
                                class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full bg-slate-500 bg-opacity-50">
                                <div class="relative w-full max-w-md max-h-full">
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <button type="button"
                                            class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                                            data-modal-hide="modalEliminar{{ $orden->id }}">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        <div class="p-6 text-center">
                                            <svg aria-hidden="true"
                                                class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                                                ¿Seguro que deseas cancelar esta orden?</h3>
                                            <button wire:click="cancelarOrden({{ $orden->id }})"
                                                data-modal-hide="modalEliminar{{ $orden->id }}" type="button"
                                                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                Sí, cancelar orden
                                            </button>
                                            <button data-modal-hide="modalEliminar{{ $orden->id }}" type="button"
                                                class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No,
                                                mantener la orden</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                    @if (count($ordenesEliminadas) > 0)
                        <div class="container mx-auto px-6 mt-32">

                            <div class="flex justify-between max-w-full">
                                <h3 class="text-gray-700 text-2xl font-bold mb-8">Ordenes canceladas</h3>
                            </div>

                            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead
                                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            @role('admin')
                                            <th scope="col" class="px-6 py-3">
                                                Usuario
                                            </th>
                                            @endrole
                                            <th scope="col" class="px-6 py-3">
                                                Estado
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Entrega
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Fecha estimada
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Total
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                <span class="sr-only">Opciones</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ordenesEliminadas as $orden)
                                            <tr
                                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                @role('admin')
                                                <th scope="row"
                                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    {{ $orden->user->name }}
                                                </th>
                                                @endrole
                                                <th scope="row"
                                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    Cancelada
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{ $orden->tipo }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    @if ($orden->fecha == null)
                                                        Por determinar...
                                                    @else
                                                        {{ $orden->fecha }}
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4">
                                                    {{ $orden->total }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    <button wire:click="recuperarOrden({{ $orden->id }})"
                                                        class="btn font-medium text-blue-600 hover:underline border outline-blue-500 p-2">Recuperar
                                                        orden</button>
                                                    <button wire:click="eliminarOrden({{ $orden->id }})"
                                                        class="btn font-medium text-red-600 hover:underline border outline-red-500 p-2">Eliminar
                                                        permanentemente</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </main>
                {{-- <x-welcome /> --}}
            </div>
        </div>
    </div>


</div>
