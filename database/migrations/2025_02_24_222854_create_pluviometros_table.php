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
        Schema::create('pluviometros', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_sensor')->default('HC-SR04');
            $table->foreignId('id_usuario');
            $table->decimal('cantidad_lluvia');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pluviometros');
    }
};
