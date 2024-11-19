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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);  // No acepta nulos
            $table->string('descripcion', 255)->nullable();  // Acepta nulos
            $table->decimal('precio_unitario', 10, 2)->unsigned();  // No acepta nulos, solo valores positivos
            $table->integer('stock')->unsigned()->default(0);  // No acepta nulos, solo valores positivos, por defecto 0
            $table->string('talla', 45)->nullable(); 
            $table->string('color', 45)->nullable();  // Acepta nulos
            $table->string('genero', 45)->nullable();  // Acepta nulos
            $table->string('img_path',255)->nullable();
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
        Schema::dropIfExists('productos');
    }
};
