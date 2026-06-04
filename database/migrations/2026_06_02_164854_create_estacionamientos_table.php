<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('estacionamientos', function (Blueprint $table) {

            $table->id();

            $table->string('tipo_estacionamiento');
            $table->string('numero_estacionamiento');
            $table->string('ubicacion')->nullable();
            $table->text('detalle')->nullable();
            $table->foreignId('propietario_id')->constrained('propietarios')->onDelete('cascade');
            $table->integer('edificio_id')->unsigned();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estacionamientos');
    }
};
