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
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id();
            $table->String('mensaje')->nullable();
            $table->foreignId('denuncia_id')->constrained(table:'denuncias');
            $table->foreignId('user_id')->constrained(table:'users');
            $table->String('datos')->nullable();  // EL JSON 
            $table->boolean('estado')->default(1);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comentarios');
    }
};
