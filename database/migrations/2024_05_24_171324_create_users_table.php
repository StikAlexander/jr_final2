<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->enum('tipo_documento', ['CC', 'TI', 'RC', 'CE', 'PEP', 'NIT']);
            $table->string('numero_documento', 10)->default('');
            $table->string('username')->unique()->default('valor_predeterminado');
            $table->string('razon_social', 100)->nullable();
            $table->enum('cargo', ['GERENCIAL', 'TECNICO', 'CONTABILIDAD']);
            $table->string('telefono', 10)->nullable();
            $table->dateTime('fecha_creacion')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('foto_perfil')->nullable();
            $table->enum('tipo_usuario', ['cliente', 'colaborador', 'administrador']);
            $table->string('name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void```
