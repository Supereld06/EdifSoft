<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('recibo_expensas_tiendas', function (Blueprint $table) {

            $table->id();
            $table->string('numero');
            $table->date('fecha');
            $table->foreignId('propietario_id')->constrained();
            $table->foreignId('expensa_tienda_id')->constrained('expensas_tiendas')->cascadeOnDelete();
            $table->foreignId('tienda_id')->constrained()->cascadeOnDelete();
            $table->decimal('monto', 10, 2);
            $table->string('moneda');
            $table->string('mes');
            $table->integer('gestion');
            $table->string('tipo_pago');
            $table->string('numero_deposito')->nullable();
            $table->foreignId('edificio_id')->constrained();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recibo_expensas_tiendas');
    }
};