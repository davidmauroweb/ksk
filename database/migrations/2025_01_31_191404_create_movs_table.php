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
        Schema::create('movs', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('art_id')->nullable('false');
            $table->smallInteger('cantidad')->nullable('false');
            $table->unsignedMediumInteger('precio')->nullable('false');
            $table->string('concepto',15)->nullable('false');
            $table->foreignId('acc_id')->nullable('false');
            $table->tinyText('obs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movs');
    }
};
