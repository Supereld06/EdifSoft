<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('apertura_expensas', function (Blueprint $table) {

            $table->id();
            $table->string('mes');
            $table->year('gestion');
            $table->decimal('saldo_inicial', 10, 2)->default(0);
            $table->decimal('efectivo_inicial', 10, 2)->default(0);
            $table->decimal('expensa_departamentos', 10, 2)->default(0);
            $table->decimal('expensa_tiendas', 10, 2)->default(0);
            $table->decimal('expensa_parqueo', 10, 2)->default(0);
            $table->decimal('factura_agua', 10, 2)->default(0);
            $table->decimal('prorrateo_agua', 10, 2)->default(0);
            $table->foreignId('edificio_id')->constrained('edificios')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apertura_expensas');
    }
};