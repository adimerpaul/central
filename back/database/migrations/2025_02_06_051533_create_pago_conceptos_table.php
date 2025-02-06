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
        Schema::create('pago_conceptos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('user_pago_id');
            $table->unsignedBigInteger('concepto_id');
            $table->string('comprobante')->nullable();
            $table->string('descripcion');
            $table->integer('monto');
            $table->string('estado');
            $table->date('fecha_pago');
            $table->string('hora_pago');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('concepto_id')->references('id')->on('conceptos');
            $table->foreign('user_pago_id')->references('id')->on('users');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pago_conceptos');
    }
};
