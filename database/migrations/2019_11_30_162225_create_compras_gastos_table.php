<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComprasGastosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras_gastos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('codigo');
            $table->string('nombre');
            $table->string('acomulado_debe');
            $table->string('acomulado_haber');
            $table->string('saldo');
            $table->integer('tipo_estado_id');
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
        Schema::drop('compras_gastos');
    }
}
