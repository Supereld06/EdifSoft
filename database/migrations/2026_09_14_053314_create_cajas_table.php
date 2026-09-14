<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cajas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('edificio_id')
                ->constrained('edificios')
                ->cascadeOnDelete();

            $table->string('nombre');
            $table->text('descripcion')->nullable();

            $table->decimal('saldo', 12, 2)->default(0);

            $table->boolean('estado')->default(true);

            $table->timestamps();

            $table->index(['edificio_id', 'estado']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cajas');
    }
};