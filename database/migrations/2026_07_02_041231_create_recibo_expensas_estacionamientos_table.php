<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('recibo_expensas_estacionamientos', function (Blueprint $table) {

            $table->id();

            $table->string('numero');

            $table->date('fecha');

            $table->foreignId('propietario_id')->constrained();

            $table->unsignedBigInteger('expensa_estacionamiento_id');

            $table->foreign(
                'expensa_estacionamiento_id',
                'fk_recibo_exp_est'
            )
                ->references('id')
                ->on('expensas_estacionamientos')
                ->cascadeOnDelete();

            $table->unsignedBigInteger('estacionamiento_id');

            $table->foreign(
                'estacionamiento_id',
                'fk_recibo_est'
            )
                ->references('id')
                ->on('estacionamientos')
                ->cascadeOnDelete();

            $table->decimal('monto', 10, 2);

            $table->string('moneda');

            $table->string('mes');

            $table->integer('gestion');

            $table->string('tipo_pago');

            $table->string('numero_deposito')->nullable();

            $table->foreignId('edificio_id')
                ->constrained();

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recibo_expensas_estacionamientos');
    }
};