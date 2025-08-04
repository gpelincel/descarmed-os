<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('ordem_servicos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('descricao')->nullable();
            $table->string('codigo_compra')->nullable();
            $table->string('nota_fiscal')->nullable();
            $table->date('data_agendamento')->nullable();
            $table->date('data_inicio');
            $table->date('data_conclusao')->nullable();
            $table->decimal('valor_total', 8, 2)->nullable();
            $table->foreignId('id_classificacao');
            $table->foreignId('id_cliente');
            $table->foreignId('id_status')->nullable();
            $table->foreignId('id_equipamento')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('ordem_servicos');
    }
};
