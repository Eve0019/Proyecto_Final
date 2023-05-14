<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Carrito extends Component
{
    public $idProductos;
    public $cantidadProductos = 0;


    public function render()
    {
        return view('livewire.carrito');
    }
}
