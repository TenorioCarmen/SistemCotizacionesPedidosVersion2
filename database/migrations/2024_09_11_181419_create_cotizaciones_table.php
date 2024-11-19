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
        Schema::create('cotizaciones', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha_hora');  // No acepta nulos
            $table->decimal('impuestos', 10, 2)->nullable()->unsigned();  // Acepta nulos, solo valores positivos
            $table->decimal('total', 10, 2)->unsigned();  // No acepta nulos, solo valores positivos
            $table->enum('estado', ['pendiente', 'aprobada', 'rechazada', 'vencida'])->default('pendiente');  // No acepta nulos
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');  // No acepta nulos, relación con la tabla clientes
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');  // No acepta nulos, relación con la tabla users 
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
        Schema::dropIfExists('cotizaciones');
    }
};
