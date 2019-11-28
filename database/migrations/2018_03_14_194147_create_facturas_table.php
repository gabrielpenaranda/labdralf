<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('numero', 10);
            $table->date('fecha');
            $table->float('monto', 12, 2);
            $table->float('saldo', 12, 2);
            $table->float('iva', 12, 2);
            $table->enum('documento', ['Factura', 'Nota de Entrega']);
            $table->bigInteger('terceros_id')->unsigned();

            $table->foreign('terceros_id')->references('id')->on('terceros')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facturas');
    }
}
