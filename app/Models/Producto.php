<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Producto extends Model
{
    use HasFactory;

    public $cantidad = null;

    protected $fillable = ['nombre','precio','categoria','descripcion','pedidos','imagen'];

    /* public function setCantidad($cantidad)
    {
        $this->attributes['cantidad'] = $cantidad;
    } */

    public function ordenes()
    {
        return $this->belongsToMany(Orden::class)->withPivot('cantidad');
    }

    protected function categoria(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucfirst($value),
        );
    }
}
