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
        Schema::create('vtas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->unsignedSmallInteger('cli_id')->constrained()->nullable('false');
            $table->timestamps();
            $table->foreign('cli_id')->references('id')->on('clientes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vtas');
    }
};
