<?php

namespace App\Http\Livewire;

use App\Models\Producto;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class VerProducto extends Component
{
    public Producto $producto;
    public $crearModal = false;
    public $flashMessage = false;
    public $cantidad = 1;

    protected $listeners = ['mostrarProducto' => 'cargarProducto'];


    public function mount(){
        $this->producto = new Producto;
        $this->producto->nombre = "";
        $this->producto->precio = 0;
        $this->producto->pedidos = 0;
        $this->producto->descripcion = "";
    }

    public function cargarProducto(Producto $producto)
    {
        $this->producto = $producto;
        $this->crearModal = true;
        $this->cantidad = 1;
    }
    public function aumentar()
    {
        if($this->cantidad <= 20){
            $this->cantidad++;
        }
    }
    public function disminuir()
    {
        if($this->cantidad > 1){
            $this->cantidad--;
        }
    }

    public function agregarCarrito()
    {
        $this->emit('agregarAlCarrito',$this->producto->id,$this->cantidad);
    }

    public function cerrarModalVer(){
        $this->crearModal = false;
        $this->flashMessage = false;
    }

    public function eliminarProducto(){
        Storage::delete('public/'.$this->producto->imagen);
        $this->producto->delete();
        $this->crearModal = false;
        $this->emit('renderProductos','Producto Eliminado');
    }
    


    public function render()
    {
        return view('livewire.ver-producto');
    }
}
