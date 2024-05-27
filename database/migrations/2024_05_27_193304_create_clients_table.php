<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_documento_cliente');
            $table->string('numero_documento_cliente');
            $table->string('razon_social')->nullable();
            $table->string('nombres_cliente')->nullable();
            $table->string('apellidos_cliente')->nullable();
            $table->string('correo_cliente')->nullable();
            $table->string('telefono_cliente')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
