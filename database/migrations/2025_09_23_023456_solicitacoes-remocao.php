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
        Schema::create('solicitacoes_remocao', function (Blueprint $table) {
            $table->id();
            $table->string('cnpj', 18);
            $table->string('razao_social');
            $table->string('nome_solicitante');
            $table->string('email_solicitante');
            $table->text('motivo');
            $table->string('status')->default('pendente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitacoes_remocao');
    }
};
