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
            $table->string('descricao');
            $table->foreignId('id_status');
            $table->integer('classificacao');
            $table->date('data_inicio');
            $table->date('data_conclusao')->nullable();
            $table->decimal('preco', 8, 2)->nullable();
            $table->foreignId('id_equipamento');
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
