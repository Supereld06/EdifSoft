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
        Schema::create('recibo_expensas', function (Blueprint $table) {

            $table->id();

            $table->string('numero');

            $table->date('fecha');

            $table->foreignId('propietario_id')
                ->constrained('propietarios');

            $table->foreignId('expensa_id')
                ->constrained('expensas');

            $table->foreignId('departamento_id')
                ->constrained('departamentos');

            $table->decimal('monto', 10, 2);

            $table->enum('moneda', [
                'Bolivianos',
                'Dolares'
            ]);

            $table->string('mes');

            $table->string('gestion');

            $table->enum('tipo_pago', [
                'Efectivo',
                'Deposito',
                'QR'
            ]);

            $table->string('numero_deposito')
                ->nullable();

            $table->foreignId('edificio_id')
                ->constrained('edificios');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recibo_expensas');
    }
};