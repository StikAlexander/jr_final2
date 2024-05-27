<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollaboratorsTable extends Migration
{
    public function up()
    {
        Schema::create('collaborators', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_documento_colaborador');
            $table->string('numero_documento_colaborador');
            $table->string('nombres_colaborador');
            $table->string('apellidos_colaborador');
            $table->string('cargo_colaborador');
            $table->string('contrasena_colaborador');
            $table->string('correo_colaborador');
            $table->string('telefono_colaborador')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('collaborators');
    }
}
