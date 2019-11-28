<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre', 50);
            $table->string('codigo', 8);
            $table->decimal('capacidad', 4, 2);
            $table->bigInteger('tipoproductos_id')->unsigned();
            $table->bigInteger('unidadmedidas_id')->unsigned();

            $table->foreign('unidadmedidas_id')->references('id')->on('unidadmedidas')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('tipoproductos_id')->references('id')->on('tipoproductos')->onUpdate('cascade')->onDelete('restrict');
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
}
