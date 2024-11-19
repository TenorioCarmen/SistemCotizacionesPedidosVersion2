<?php

namespace Database\Seeders;

use App\Models\Pedido;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoEnvioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pedido::insert([
            [
                'tipo_envio' => 'Entrega presencial',
                'fecha_pedido' => Carbon::now(),
                'total' => 0,
                'estado_pedido' => 'pendiente',
                'id_cliente' => 1,
                'id_usuario' => 1,
                '' => 1,
                
            ],
            [
                'tipo_envio' => 'Envio por bus',
                'fecha_pedido' => Carbon::now(),
                'total' => 0,
            ]
            ]);
    }
}
