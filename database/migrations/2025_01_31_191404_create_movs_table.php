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
            $table->unsignedSmallInteger('art_id');
            $table->smallInteger('cantidad');
            $table->unsignedMediumInteger('costo');
            $table->unsignedMediumInteger('venta')->nullable();
            $table->foreignId('acc_id');
            $table->tinyText('obs')->nullable();
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
