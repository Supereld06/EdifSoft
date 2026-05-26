<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('tiendas', function (Blueprint $table) {

            $table->id();
            $table->string('tipo_tienda');
            $table->string('numero_tienda');
            $table->string('ubicacion');
            $table->text('detalles_tienda')->nullable();
            $table->foreignId('propietario_id')->constrained('propietarios')->onDelete('cascade');
            $table->integer('edificio_id')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tiendas');
    }
};