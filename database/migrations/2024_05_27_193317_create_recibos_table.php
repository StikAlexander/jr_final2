<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecibosTable extends Migration
{
    public function up()
    {
        Schema::create('recibos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pago_id');
            $table->string('numero_recibo');
            $table->date('fecha_recibo');
            $table->timestamps();

            $table->foreign('pago_id')->references('id')->on('pagos');
        });
    }

    public function down()
    {
        Schema::dropIfExists('recibos');
    }
}
