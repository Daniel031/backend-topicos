<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('contraseñas', function (Blueprint $table) {
            $table->id();
            $table->string('password');
            $table->boolean('activo')->default(0);
            $table->foreignId('user_id')->constrained(
                table:'users'
            );
            $table->timestamps();
        });

    }

    
    public function down(): void
    {
        Schema::dropIfExists('contraseñas'); 
    }
};
