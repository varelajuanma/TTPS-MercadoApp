<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfiguracionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuraciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('palabras');
            $table->integer('cantidad_palabras');
            $table->integer('cantidad_opiniones');
            $table->integer('cantidad_pesos_por_punto');
            $table->double('porcentaje_comision');
            $table->double('porcentaje_descuento_productos_asociados');
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
        Schema::dropIfExists('configuraciones');
    }
}
