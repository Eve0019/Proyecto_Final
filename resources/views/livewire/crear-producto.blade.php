<div>
    <x-button wire:click="$toggle('crearModal')">Agregar producto</x-button>
    <x-dialog-modal wire:model="crearModal">
        
        <x-slot name="title">
            @if($editando)
                    Editando: {{ $nombre }}
                @else
                    Crear Producto
                @endif
        </x-slot>
    
        <x-slot name="content">
            
            <form wire:submit.prevent>
                @csrf
            <div class="mb-6">
                <label for="name" class="block mb-2 text-sm font-medium text-black-700">Nombre *</label>
                <input type="text" wire:model.defer="nombre" placeholder="Nombre del Producto" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" >

                @error('nombre')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Error: </span> {{$message}}!</p>
                @enderror
              </div>

              <div class="mb-6">
                <label for="price" class="block mb-2 text-sm font-medium text-black-700">Precio *</label>
                <input type="number" wire:model.defer="precio" placeholder="Precio del Producto" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">

                @error('precio')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{$message}}!</p>
                @enderror
              </div>
              
              <div class="mb-6">
                <label for="category" class="block mb-2 text-sm font-medium text-black-700">Categoría *</label>
                <select wire:model.defer="categoria" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" required>
                    <option value="">Elegir...</option>
                    @foreach ($categorias as $cat)
                    {{ Debugbar::info($editando,$categoria,$cat) }}
                    <option value="{{ $cat }}" {{ ($editando && ($categoria == $cat)) ? 'selected' : '' }}>{{ Str::ucfirst($cat) }}</option>    
                    @endforeach
                    {{-- <option {{ $producto->categoria == 'acondicionador' ? 'selected' : '' }} value="acondicionador" > Acondicionador</option>
                    <option {{ $producto->categoria == 'jabón' ? 'selected' : '' }} value="jabón" > Jabón</option>
                    <option {{ $producto->categoria == 'crema' ? 'selected' : '' }} value="crema"> Crema</option>
                    <option {{ $producto->categoria == 'pasta denta' ? 'selected' : '' }} value="pasta dental"> Pasta Dental</option> --}}
                </select>
                @error('categoria')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{$message}}!</p>
                @enderror
              </div>
              <div class="mb-6">
                <label for="description" class="block mb-2 text-sm font-medium text-black-700">Descripción *</label>
                <textarea rows="4" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" placeholder="Descripción del Producto..." wire:model.defer="descripcion"></textarea>
                @error('descripcion')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{$message}}!</p>
                @enderror
            </div>

            <input type="file" wire:model="imagen">
            <div wire:loading wire:target="imagen">Subiendo...</div>
            @error('imagen') <span class="error">{{ $message }}</span> @enderror
            @if ($imagen)
                Preview del Producto:
                <img src="{{ $imagen->temporaryUrl() }}">
            @elseif($imagenEditando)
                <img src="{{ asset('storage/'. $imagenEditando) }}" alt="Imagen de {{ $nombre }}">
            @endif
            {{-- <div class="mb-6">
              <label for="stock" class="block mb-2 text-sm font-medium text-black-700">Stock</label>
              <input type="number" type="number" name="stock" id="stock" value="{{old('stock') ?? ''}}" placeholder="Product Stock" min="0" max="999" required class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">

              @error('stock')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{$message}}!</p>
                @enderror
            </div> --}}

            {{-- <div class="mb-6">  
            <label class="block mb-2 text-sm font-medium text-black-700" for="image">Foto producto</label>
            <input class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" id="image" type="file" name="image">
            <div class="mt-1 text-sm text-gray-700 ">Trata que la imagen tenga relación 1:1</div>


              @error('image')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{$message}}!</p>
                @enderror
            </div> --}}
        

            {{-- <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Crear</button> --}}
            
        </form>
        
        
        @if (session()->has('message'))
            <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative" role="alert" x-data="{show: @entangle('flashMessage').defer}" x-show="show">
                <strong class="font-bold"> Guardado Correctamente</strong>
                {{-- <span class="block sm:inline">Something seriously bad happened.</span> --}}
                <span @click="show = false" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                  <svg class="fill-current h-6 w-6 text-blue-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
            </div>
        @endif
        
        </x-slot>
    
        <x-slot name="footer">
            <x-secondary-button wire:click="cerrarModalCrear" wire:loading.attr="disabled">
                Cancelar
            </x-secondary-button>
    
            <x-button class="ml-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" wire:click="submit" wire:loading.attr="disabled">
                @if($editando)
                    Actualizar
                @else
                    Crear
                @endif
            </x-button>
        </x-slot>
    </x-dialog-modal>
    
</div>
