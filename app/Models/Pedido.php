<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    public function productos()
    {
        return $this->belongsToMany(Producto::class)->withTimestamps()->withPivot('cantidad', 'precio_pedido', 'descuento_porcentaje', 'descuento_monto', 'total_pedido');
    }

    public function cotizacione()
    {
        return $this->belongsTo(Cotizacione::class);
    }

    public function venta()
    {
        return $this->hasMany(Venta::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comprobante()
    {
        return $this->belongsTo(Comprobante::class, 'comprobante_id');
    }
}
