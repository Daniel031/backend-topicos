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
        Schema::create('fotos_denuncia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('denuncia_id')->constrained(table:'denuncias');
            $table->string('url');
            $table->integer('id_url');
            $table->boolean('estado')->default(1);
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fotos_denuncia');
    }
};
