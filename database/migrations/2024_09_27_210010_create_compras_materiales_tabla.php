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
        Schema::create('compras_materiales_tabla', function (Blueprint $table) {
            $table->id();
            
            $table->integer('cantidad')->unsigned();
            $table->decimal('precio_compra',10,2)->unsigned();
            $table->decimal('precio_venta',10,2)->unsigned();
            $table->decimal('total',10,2)->unsigned();
            $table->foreignId('compra_id')->constrained()->onDelete('cascade');
            $table->foreignId('materiale_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('compras_materiales_tabla');
    }
};
