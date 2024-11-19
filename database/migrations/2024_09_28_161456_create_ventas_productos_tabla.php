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
        Schema::create('ventas_productos_tabla', function (Blueprint $table) {
            $table->id();
            $table->integer('cantidad')->unsigned();    
            $table->decimal('precio_venta', 10, 2)->unsigned();
            $table->decimal('descuento_porcentaje', 5, 2)->nullable()->unsigned();
            $table->decimal('descuento_monto', 10, 2)->nullable()->unsigned();
            $table->decimal('total_venta', 10, 2)->unsigned();
            $table->foreignId('venta_id')->constrained('ventas')->onDelete('cascade');
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');
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
        Schema::dropIfExists('ventas_productos_tabla');
    }
};
