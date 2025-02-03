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
        Schema::create('accs', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('acc',10);
            $table->unsignedSmallInteger('cli_id')->nullable();
            $table->tinyText('obs')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accs');
    }
};
