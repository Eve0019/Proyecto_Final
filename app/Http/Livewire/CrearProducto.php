<?php

namespace App\Http\Livewire;

use App\Models\Producto;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class CrearProducto extends Component
{
    use WithFileUploads;
    public $crearModal = false;
    public $flashMessage = false;
    public $categorias;
    public $nombre;
    public $precio;
    public $categoria;
    public $descripcion;
    public $imagen;
    public $imagenEditando;
    public $editando = false;
    public $idEdicion;

    protected $listeners = ['editarProducto' => 'cargarProducto'];


    protected $rules = [
        'nombre' => 'required|min:3|max:50',
        'precio' => 'required|numeric|min:20|max:9999',
        'categoria' => 'required|min:3|max:25',
        'descripcion' => 'required|min:3|max:255',
        'imagen' => 'nullable|image|max:5000',
    ];

    public function mount(){
        $this->categorias = ['shampoo','acondicionador','jabón','crema','pasta dental'];
    }

    public function cargarProducto(Producto $producto){
        $this->editando = true;
        $this->nombre = $producto->nombre;
        $this->precio = $producto->precio;
        $this->categoria = strtolower($producto->categoria);
        $this->descripcion = $producto->descripcion;
        $this->imagenEditando = $producto->imagen;
        $this->idEdicion = $producto->id;
        $this->crearModal = true;
    }

    public function submit()
    {
        $this->validate();
 
        // Execution doesn't reach here if validation fails.
 
        $nombreImagen = $this->guardarImagen();
        if($this->editando){
            if($nombreImagen == null){
                Producto::where('id', $this->idEdicion)
                    ->update([
                        'nombre' => $this->nombre,
                        'precio' => $this->precio,
                        'categoria' => $this->categoria,
                        'descripcion' => $this->descripcion,
                        'imagen' => $this->imagenEditando,
                    ]);
            }else{
                Producto::where('id', $this->idEdicion)
                    ->update([
                        'nombre' => $this->nombre,
                        'precio' => $this->precio,
                        'categoria' => $this->categoria,
                        'descripcion' => $this->descripcion,
                        'imagen' => $nombreImagen,
                ]);
                if($this->imagenEditando != null){
                    Storage::delete('public/'.$this->imagenEditando);
                }
            }
            session()->flash('message', 'Producto editado correctamente.');
        }else{
            Producto::create([
                'nombre' => $this->nombre,
                'precio' => $this->precio,
                'categoria' => $this->categoria,
                'descripcion' => $this->descripcion,
                'imagen' => $nombreImagen,
            ]);
            session()->flash('message', 'Producto agregado correctamente.');
        }
        $this->flashMessage = true;
        $this->reset(
            'nombre',
            'precio',
            'categoria',
            'descripcion',
            'imagen',
            'imagenEditando',
            'editando'
        );
        $this->emit('renderProductos','Producto Agregado');
    }

    public function cerrarModalCrear(){
        $this->crearModal = false;
        $this->flashMessage = false;
        Debugbar::info('Se cerro el modal'. now());
        $this->reset(
            'nombre',
            'precio',
            'categoria',
            'descripcion',
            'imagen',
            'imagenEditando',
            'editando'
        );
    }
    
    public function updatedcrearModal(){
        if($this->crearModal == false){
            $this->cerrarModalCrear();
        }
    }
    
    private function guardarImagen()
    {
        $nombre = null;
        if($this->imagen){
            $nombre = $this->imagen->store('public');
            $nombre = explode("/",$nombre)[1];
            //Storage::disk('public')->put($nombre, $this->imagen);
            
        }
        return $nombre;
    }

    public function render()
    {
        return view('livewire.crear-producto');
    }
}
