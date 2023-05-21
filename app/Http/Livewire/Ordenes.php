<?php

namespace App\Http\Livewire;

use App\Models\Orden;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Spatie\Permission\Traits\HasRoles;


class Ordenes extends Component
{

    public $ordenes;
    public $ordenesEliminadas;
    public $estadosOrden;
    public $estado;
    public $fecha;


    public function mount(){
        $user = Auth::user();
        if($user->hasRole('admin')){
            $this->ordenes = Orden::with('productos')->orderBy('created_at','desc')->get();
            $this->ordenesEliminadas = Orden::onlyTrashed()->with('productos')->orderBy('deleted_at','desc')->get();
        }else{
            $this->ordenes = Orden::with('productos')->where('user_id',$user->id)->orderBy('created_at','desc')->get();
            $this->ordenesEliminadas = Orden::onlyTrashed()->with('productos')->where('user_id',$user->id)->orderBy('deleted_at','desc')->get();
        }
        $this->estadosOrden = ['Procesando Pedido','Preparando productos','Enviando a la tienda...','Pedido en tienda','Recogido'];
    }

    public function cancelarOrden($id){
        Orden::destroy($id);
        $this->dispatchBrowserEvent('toast',['title'=> 'Se canceló la orden','message'=>'Puedes recuperarla en cualquier momento']);
        return redirect(request()->header('Referer'));
    }
    public function eliminarOrden($id){
        $orden = Orden::withTrashed()->where('id',$id)->first();
        foreach($orden->productos as $producto){
            $producto->pedidos -= $producto->pivot->cantidad;
            $producto->save();
        }
        $orden->forceDelete();
        $this->dispatchBrowserEvent('toast',['title'=> 'Orden eliminada','message'=>'Se eliminó permanentemente']);
        //Refrescar
        return redirect(request()->header('Referer'));
    }

    public function recuperarOrden($id){
        $orden = Orden::withTrashed()->where('id',$id)->first();
        $orden->restore();
        $this->dispatchBrowserEvent('toast',['title'=> 'Orden recuperada','message'=>'Puedes consultarla nuevamente']);
        return redirect(request()->header('Referer'));
    }

    public function actualizarOrden(Orden $orden){
        if($this->fecha){
            try {
                $carbonFecha = Carbon::parse($this->fecha);
                if ($carbonFecha->isValid()) {
                    $orden->fecha = $this->fecha;
                    $orden->save();
                    $orden->fecha = null;
                    $this->dispatchBrowserEvent('toast',['title'=> 'Orden actualizada','message'=>'El cliente podrá ver los cambios']);
                }else{
                    $this->dispatchBrowserEvent('toast',['title'=> 'Error','message'=>'Fecha incorrecta, revisa el formato','success'=>'false']);
                }
            } catch (\Exception $e) {
                $this->dispatchBrowserEvent('toast',['title'=> 'Error','message'=>'Fecha incorrecta, revisa el formato','success'=>'false']);
                return redirect(request()->header('Referer'));
                echo 'invalid date, enduser understands the error message';
            }
            return redirect(request()->header('Referer'));
        }
        if($this->estado){
            $orden->estado = $this->estado;
            $orden->save();
            $orden->estado = null;
            $this->dispatchBrowserEvent('toast',['title'=> 'Orden actualizada','message'=>'El cliente podrá ver los cambios']);
            return redirect(request()->header('Referer'));
        }
        if($this->fecha == null && ($this->estado == "" || $this->estado == null)){
            $this->dispatchBrowserEvent('toast',['title'=> 'Error','message'=>'No seleccionaste los campos o la información es incorrecta','success'=>'false']);
            return redirect(request()->header('Referer'));
        }
        //return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('livewire.ordenes');
    }
}
