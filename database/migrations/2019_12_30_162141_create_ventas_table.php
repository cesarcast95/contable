<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('codigo');
            $table->integer('tipo_transaccion_id');
            $table->integer('tipo_estado_id');
            $table->string('fecha_elaboracion');
            $table->string('identificacion');
            $table->string('sucursal');
            $table->string('nombre');
            $table->integer('cliente_id')->unsigned();
            $table->foreign('cliente_id')
                  ->references('id')
                  ->on('clientes_ids')
                  ->onDelete('cascade');
            $table->integer('producto_id')->unsigned();
            $table->foreign('producto_id')
                  ->references('id')
                  ->on('productos')
                  ->onDelete('cascade');
            $table->integer('empresa_id')->unsigned();
            $table->foreign('empresa_id')
                  ->references('id')
                  ->on('empresas')
                  ->onDelete('cascade');
            $table->string('total');
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
        Schema::drop('ventas');
    }
}
