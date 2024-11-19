<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    public function comprobante(){
        return $this->belongsTo(Comprobante::class);
    }

    public function productos(){
        return $this->belongsToMany(Producto::class)->withTimestamps()->withPivot('cantidad','precio_venta','descuento_porcentaje','descuento_monto','total_venta');
    }

    public function pedido(){
        return $this->belongsTo(Pedido::class);
    }

    public function pago(){
        return $this->hasMany(Pago::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
