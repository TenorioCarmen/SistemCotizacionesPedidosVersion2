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
        Schema::table('cotizacion_producto_tabla', function (Blueprint $table) {
            $table->decimal('costo_materiales', 8, 2)->nullable()->after('cantidad'); // Ajusta el tamaño si es necesario
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cotizacion_producto_tabla', function (Blueprint $table) {
            $table->dropColumn('costo_materiales');
        });
    }
};
