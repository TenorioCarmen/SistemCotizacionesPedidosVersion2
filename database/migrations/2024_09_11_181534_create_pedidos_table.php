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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha_pedido');  // No acepta nulos
            $table->string('tipo_envio', 105)->nullable();  // Acepta nulos
            $table->string('tiempo_entrega', 105)->nullable();  // Acepta nulos
            $table->decimal('impuestos', 10, 2)->nullable()->unsigned();  // Acepta nulos, solo valores positivos
            $table->decimal('total', 10, 2)->unsigned();  // No acepta nulos, solo valores positivos
            $table->enum('estado', ['pendiente', 'en_proceso', 'entregado', 'cancelado'])->default('pendiente');  // No acepta nulos
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');  // No acepta nulos, relación con la tabla users 
            /**$table->foreignId('clientes_id')->constrained()->onDelete('cascade');**/  // No acepta nulos, relación con la tabla clientes
            $table->foreignId('cotizacione_id')->constrained('cotizaciones')->onDelete('cascade');  // No acepta nulos, relación con la tabla cotizaciones

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
        Schema::dropIfExists('pedidos');
    }
};
