<?php

namespace App\Http\Livewire;

use App\Models\Producto;
use Livewire\Component;
use \Illuminate\Database\Eloquent\Collection;

class Carrito extends Component
{
    public $productosId;
    public $productosCarrito;
    public $cantidadProductos = 0;
    public $arrayCantidad;
    public $crearModal = false;

    public function mount(){
        $this->productosCarrito = new \Illuminate\Database\Eloquent\Collection();
        $this->cantidadProductos = 0;
        $this->arrayCantidad = [];
        $this->productosId = [];
    }

    protected $listeners = ['agregarAlCarrito','limpiarCarrito'];

    public function agregarAlCarrito($id,$cantidad){
        if(!$this->productosCarrito->contains($id)){
            $producto = Producto::find($id);
            $producto->cantidad = $cantidad;
            $this->productosCarrito->push($producto);
            $this->cantidadProductos++;
            array_push($this->arrayCantidad,$cantidad);
            array_push($this->productosId,$id);
            $this->dispatchBrowserEvent('toast',['title'=> 'Producto Agregado','message'=>'El producto se agregó al carrito']);
        }else{
            $this->dispatchBrowserEvent('toast',['title'=> 'Producto Repetido','message'=>'El producto ya está en el carrito','success'=>'false']);
        }
    }

    public function eliminarProductoCarrito($id){
        $productIndex = $this->productosCarrito->search(function($producto) use ($id){
            return $producto->id === $id;
        });
        $this->productosCarrito = $this->productosCarrito->except([$id]);
        array_splice($this->arrayCantidad, $productIndex,1);
        array_splice($this->productosId, $productIndex,1);
        $this->cantidadProductos--;
        $this->dispatchBrowserEvent('toast',['title'=> 'Producto Removido','message'=>'El producto se removió del carrito']);
    }

    public function limpiarCarrito(){
        $this->productosCarrito = new \Illuminate\Database\Eloquent\Collection();
        $this->cantidadProductos = 0;
        $this->arrayCantidad = [];
        $this->productosId = [];
    }

    public function actualizarCantidad($id,$cantidad){
        if($this->productosCarrito->contains($id)){
            $productIndex = $this->productosCarrito->search(function($producto,$id) {
                return $producto->id === $id;
            });
            $this->arrayCantidad[$productIndex] = $cantidad;
            /* $producto = $this->productosCarrito->find($id);
            $producto->cantidad = $cantidad;
            $this->productosCarrito->put($producto->id, $producto); */
            $this->dispatchBrowserEvent('toast',['title'=> 'Producto Actualizado','message'=>'Cantidad actualizada']);
        }
    }

    public function aumentar($index){
        if($this->arrayCantidad[$index] < 50){
            $this->arrayCantidad[$index]++;
        }
    }
    public function disminuir($index){
        if($this->arrayCantidad[$index] > 1){
            $this->arrayCantidad[$index]--;
        }
    }

    public function cerrarModalVer(){
        $this->crearModal = false;
    }

    public function verCarrito(){
        $this->crearModal = true;
    }

    public function render()
    {
        return view('livewire.carrito');
    }
}
