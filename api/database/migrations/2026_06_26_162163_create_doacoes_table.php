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
        Schema::create('doacoes', function (Blueprint $table) {
            $table->id();
            $table->boolean('ativo')->default(1);
            $table->text('detalhes')->nullable();
            $table->foreignId('categoria_doacao_id')->references('id')->on('categorias_doacao')->onDelete('cascade');
            $table->foreignId('perfil_doacao_id')->references('id')->on('perfis_doacao')->onDelete('cascade');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doacoes');
    }
};
