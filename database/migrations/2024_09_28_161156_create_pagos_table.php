<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha_pago');  // No acepta nulos
            $table->decimal('monto_pago', 10, 2)->unsigned();  // No acepta nulos, solo valores positivos
            $table->enum('tipo_pago', ['efectivo', 'tarjeta', 'transferencia']);  // No acepta nulos
            $table->enum('estado', ['pendiente', 'completado', 'cancelado'])->default('pendiente');  // Estado del pago, por defecto 'pendiente'
            $table->foreignId('venta_id')->constrained('ventas')->onDelete('cascade');  // No acepta nulos, relación con la tabla ventas
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagos');
    }
};
