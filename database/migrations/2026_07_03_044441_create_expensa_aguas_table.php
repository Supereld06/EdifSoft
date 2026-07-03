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
        Schema::create('expensas_aguas', function (Blueprint $table) {

            $table->id();
            $table->foreignId('departamento_id')->constrained('departamentos')->cascadeOnDelete();
            $table->foreignId('propietario_id')->constrained('propietarios')->cascadeOnDelete();
            $table->foreignId('edificio_id')->constrained('edificios')->cascadeOnDelete();
            $table->foreignId('apertura_expensa_id')->constrained('apertura_expensas')->cascadeOnDelete();
            $table->decimal('lectura_anterior', 10, 2)->nullable();
            $table->decimal('lectura_actual', 10, 2)->nullable();
            $table->decimal('lectura_pagar', 10, 2)->nullable();
            $table->decimal('prorrateo', 10, 2)->nullable();
            $table->decimal('pago', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expensas_aguas');
    }
};
