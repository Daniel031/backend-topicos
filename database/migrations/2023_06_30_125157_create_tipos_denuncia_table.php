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
        Schema::create('tipos_denuncia', function (Blueprint $table) {
            $table->id();
            $table->String('nombre');
            $table->String('descripcion')->nullable();
            $table->boolean('estado')->default(1);
            //$table->foreignId('area_id')->constrained(table:'areas')->nullable();
            $table->unsignedBigInteger('area_id')->nullable(); 
            $table->timestamps();
            $table->foreign('area_id')->references('id')->on('areas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipos_denuncia');
    }
};
