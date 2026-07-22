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
        Schema::create('consentimentos_documentos', function (Blueprint $table) {
            $table->id();
            $table->string('ip');
            $table->string('user_agent');
            $table->foreignId('politica_privacidade_id')->references('id')->on('politicas_privacidade')->onDelete('cascade');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('termo_uso_id')->references('id')->on('termos_uso')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consentimentos_documentos');
    }
};
