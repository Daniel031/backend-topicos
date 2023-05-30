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
        Schema::create('denuncias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(table:'users');
            $table->string('titulo');
            $table->string('descripcion');
            $table->date('fecha');
            $table->time('hora',4);
            $table->unsignedSmallInteger('estado')->default('1');   // ESTADO 1 DICE EN REVISION
            $table->string('hash');
            $table->string('latitud');
            $table->string('longitud');
            $table->unsignedSmallInteger('tipo_denuncia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('denuncias');
    }
};
