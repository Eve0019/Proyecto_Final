<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orden extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'ordenes';
    protected $fillable = ['tipo','direccion','fecha','estado','total','user_id'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function productos()
    {
        return $this->belongsToMany(Producto::class)->withPivot('cantidad');
    }
}
