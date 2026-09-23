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
        Schema::create('movimientos_caja', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | CAJA
            |--------------------------------------------------------------------------
            */

            $table->foreignId('caja_id')
                ->constrained('cajas')
                ->cascadeOnDelete();

            $table->foreignId('tipo_movimiento_id')
                ->nullable()
                ->constrained('tipos_movimiento')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            /*
            |--------------------------------------------------------------------------
            | TIPO DE MOVIMIENTO
            |--------------------------------------------------------------------------
            |
            | ingreso = dinero que entra
            | egreso  = dinero que sale
            |
            */

            $table->enum('tipo', [
                'ingreso',
                'egreso'
            ]);


            /*
            |--------------------------------------------------------------------------
            | INFORMACIÓN DEL MOVIMIENTO
            |--------------------------------------------------------------------------
            */

            $table->string('concepto');

            $table->decimal('monto', 12, 2);

            $table->decimal(
                'saldo_anterior',
                12,
                2
            );

            $table->decimal(
                'saldo_nuevo',
                12,
                2
            );


            /*
            |--------------------------------------------------------------------------
            | TRANSFERENCIAS
            |--------------------------------------------------------------------------
            |
            | Los dos movimientos de una transferencia
            | comparten el mismo transferencia_id.
            |
            */

            $table->string('transferencia_id')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | REFERENCIAS
            |--------------------------------------------------------------------------
            */

            $table->string('referencia_tipo')
                ->nullable();

            $table->unsignedBigInteger('referencia_id')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | USUARIO QUE REGISTRA
            |--------------------------------------------------------------------------
            */

            $table->foreignId('usuario_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();


            /*
            |--------------------------------------------------------------------------
            | FECHA
            |--------------------------------------------------------------------------
            */

            $table->dateTime('fecha');


            /*
            |--------------------------------------------------------------------------
            | OBSERVACIÓN
            |--------------------------------------------------------------------------
            */

            $table->text('observacion')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | CONTROL DE ESTADO
            |--------------------------------------------------------------------------
            |
            | activo  = movimiento válido
            | anulado = movimiento anulado
            |
            */

            $table->string('estado')
                ->default('activo');


            /*
            |--------------------------------------------------------------------------
            | INFORMACIÓN DE ANULACIÓN
            |--------------------------------------------------------------------------
            */

            $table->foreignId('anulado_por')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->dateTime('anulado_en')
                ->nullable();

            $table->text('motivo_anulacion')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | TIMESTAMPS
            |--------------------------------------------------------------------------
            */

            $table->timestamps();


            /*
            |--------------------------------------------------------------------------
            | ÍNDICES
            |--------------------------------------------------------------------------
            */

            $table->index('caja_id');

            $table->index('transferencia_id');

            $table->index('estado');

            $table->index([
                'referencia_tipo',
                'referencia_id'
            ]);

            $table->index('fecha');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimientos_caja');
    }
};