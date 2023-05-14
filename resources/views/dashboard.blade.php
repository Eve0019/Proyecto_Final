<x-app-layout>
   {{--  <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <main class="my-8">
                    <div class="container mx-auto px-6">
                        
                        <div class="flex justify-between max-w-full">
                            <h3 class="text-gray-700 text-5xl font-bold mb-8">Tienda</h3>
                            @role('user')
                                @livewire('carrito')
                            @else
                                @livewire('crear-producto')
                            @endrole
                        </div>
                        {{-- {open ? <PopOver /> : null} --}}

                       {{--  <a onClick={clickHandler}>
                        </a> --}}
                        @livewire('listado-categorias')
                        @livewire('listado-productos')
                        @livewire('ver-producto')
                      </div>
                </main>
                {{-- <x-welcome /> --}}
            </div>
        </div>
    </div>
</x-app-layout>
