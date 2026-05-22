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
        Schema::create('expensas', function (Blueprint $table) {

            $table->id();
            $table->decimal('total', 10, 2);
            $table->decimal('pagado', 10, 2)->default(0);
            $table->decimal('saldo', 10, 2);
            $table->enum('estado', ['PENDIENTE','PAGADO'])->default('PENDIENTE');

            // RELACIONES
            $table->foreignId('departamento_id')
                  ->constrained('departamentos')
                  ->onDelete('cascade');

            $table->foreignId('propietario_id')
                  ->constrained('propietarios')
                  ->onDelete('cascade');

            $table->foreignId('edificio_id')
                  ->constrained('edificios')
                  ->onDelete('cascade');

            $table->foreignId('apertura_expensa_id')
                  ->constrained('apertura_expensas')
                  ->onDelete('cascade');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expensas');
    }
};