<?php

namespace App\Http\Livewire;

use App\Models\Producto;
use Livewire\Component;
use Livewire\WithPagination;

class ListadoProductos extends Component
{
    use WithPagination;

    public $categoria = '';
    public bool $verProducto = false;

    protected $listeners = ['cambioCategoria','renderProductos'];

    // public $productos;

    public function mount(){
        // $this->productos = Producto::all();   
    }

    public function cambioCategoria($categoria)
    {
        $this->categoria = $categoria;
        $this->resetPage();
    }
    public function renderProductos($mensaje,$estilo = 'success')
    {
        $this->render();
        /* session()->flash('flash.banner', $mensaje); */
        $this->dispatchBrowserEvent('banner-message', [
            'message' => $mensaje,
            'style' => $estilo
        ]);
    }

    public function mostrarProducto($id)
    {
        $this->emit('mostrarProducto',$id);
    }



    public function render()
    {
        $contenido = [];
        if($this->categoria === '' || $this->categoria === 'todos'){
            $contenido['productos'] = Producto::latest()->paginate(8);
        }else{
            $contenido['productos'] = Producto::where('categoria',$this->categoria)->latest()->paginate(8);
        }
        return view('livewire.listado-productos', $contenido);
    }
}
