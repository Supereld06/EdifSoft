<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('edificios', function (Blueprint $table) {

            $table->id();

            $table->string('nombre');
            $table->string('direccion');
            $table->integer('numero_departamentos');
            $table->string('pais')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('zona')->nullable();
            $table->string('imagen_edificio')->nullable();
            $table->string('logo_edificio')->nullable();
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('edificios');
    }
};