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
        Schema::table('status_os', function (Blueprint $table) {
            $table->boolean('ativo')->default(true);
        });

        Schema::table('unidades', function (Blueprint $table) {
            $table->boolean('ativo')->default(true);
        });

        Schema::table('classificacao_os', function (Blueprint $table) {
            $table->boolean('ativo')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('status_os', function (Blueprint $table) {
            $table->dropColumn('ativo');
        });
        Schema::table('unidades', function (Blueprint $table) {
            $table->dropColumn('ativo');
        });
        Schema::table('classificacao_os', function (Blueprint $table) {
            $table->dropColumn('ativo');
        });
    }
};
