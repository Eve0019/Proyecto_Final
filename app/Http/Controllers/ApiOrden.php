<?php

namespace App\Http\Controllers;

use App\Models\Orden;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrdenCollection;
use App\Http\Resources\OrdenResource;
use App\Http\Requests\GuardarOrdenRequest;
use App\Models\Producto;
use App\Models\User;
use Barryvdh\Debugbar\Facades\Debugbar;
use Symfony\Component\HttpKernel\Exception\HttpException;

//use App\Services\ProductQuery;

class ApiOrden extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
                
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GuardarOrdenRequest $request)
    {
            $totalOrden = $this->obtenerTotal($request->productos_id,$request->productos_array);
            $request->merge(['total' => $totalOrden]);
            $nuevaOrden = new Orden($request->except(['productos_array','user_id','productos_id']));
            $user = User::find($request->user_id);
            $user->ordenes()->save($nuevaOrden);
            $nuevaOrden->refresh();
            $productsString = $request->productos_array;
            $nuevaOrden->productos()->attach($productsString);
            return new OrdenResource($nuevaOrden);
    }

    public function obtenerTotal($productos_id,$productos_array){
        $total = 0;
        $productos = Producto::find($productos_id);

        foreach($productos as $producto){
            $total += $productos_array[$producto->id]['cantidad'] * $producto->precio;
            $producto->pedidos += $productos_array[$producto->id]['cantidad'];
            $producto->save();
        }
        return $total;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $Order
     * @return \Illuminate\Http\Response
     */
    public function show(Orden $Order)
    {
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $Order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Orden $product)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Orden $product)
    {
    }
}
