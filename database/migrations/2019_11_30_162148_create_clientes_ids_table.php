<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesIdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes_ids', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cedula');
            $table->string('nombre');
            $table->string('tel');
            $table->string('direccion');
            $table->integer('empresa_id')->unsigned();
            $table->foreign('empresa_id')
                  ->references('id')
                  ->on('empresas')
                  ->onDelete('cascade');
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
        Schema::drop('clientes_ids');
    }
}
