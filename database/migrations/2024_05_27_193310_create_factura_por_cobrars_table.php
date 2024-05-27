<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturaPorCobrarsTable extends Migration
{
    public function up()
    {
        Schema::create('factura_por_cobrars', function (Blueprint $table) {
            $table->id();
            $table->string('consecutivo_factura');
            $table->date('fecha_emision_factura');
            $table->date('fecha_vencimiento_factura');
            $table->decimal('valor_total_factura', 10, 2);
            $table->decimal('valor_abonado', 10, 2);
            $table->unsignedBigInteger('clientes_id_cliente');
            $table->string('estado_pago_factura');
            $table->string('pdf_factura');
            $table->timestamps();

            $table->foreign('clientes_id_cliente')->references('id')->on('clients');
        });
    }

    public function down()
    {
        Schema::dropIfExists('factura_por_cobrars');
    }
}
