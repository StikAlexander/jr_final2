<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('factura_id');
            $table->decimal('monto', 10, 2);
            $table->date('fecha_pago');
            $table->timestamps();

            $table->foreign('factura_id')->references('id')->on('factura_por_cobrars');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pagos');
    }
}
