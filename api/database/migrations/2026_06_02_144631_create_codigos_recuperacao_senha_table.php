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
        if (!Schema::hasTable('codigos_recuperacao_senha')) {
            Schema::create('codigos_recuperacao_senha', function (Blueprint $table) {
                $table->id();
                $table->string('email');
                $table->string('codigo_recuperacao', 6);
                $table->timestamp('expira_em');
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('codigos_recuperacao_senha');
    }
};
