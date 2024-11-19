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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha_hora');  // No acepta nulos
            $table->decimal('impuestos', 10, 2)->nullable()->unsigned();  // Acepta nulos, solo valores positivos
            $table->decimal('total', 10, 2)->unsigned();  // No acepta nulos, solo valores positivos
            $table->enum('estado', ['pendiente', 'completada', 'cancelada'])->default('pendiente');  // No acepta nulos
            $table->string('numero_comprobante',255);
            /**$table->foreignId('cliente_id')->nullable()->constrained('clientes')->onDelete('set null');**/  // No acepta nulos, relación con la tabla clientes
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');  // No acepta nulos, relación con la tabla users    
            $table->foreignId('pedido_id')->constrained('pedidos')->onDelete('cascade');  // No acepta nulos, relación con la tabla pedidos
            $table->foreignId('comprobante_id')->nullable()->constrained('comprobantes')->onDelete('set null');  // No acepta nulos, relación con la tabla comprobantes
            
            
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
        Schema::dropIfExists('ventas');
    }
};
