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
        Schema::create('art', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('nombre',50);
            $table->unsignedTinyInteger('cat_id')->constrained();
            $table->unsignedSmallInteger('marca_id')->constrained();
            $table->mediumInteger('stock')->nullable();
            $table->decimal('costo', total: 8, places: 2)->nullable();
            $table->decimal('venta', total: 8, places: 2)->nullable();
            $table->smallInteger('repo');
            $table->timestamps();
            $table->foreign('cat_id')->references('id')->on('categorias');
            $table->foreign('marca_id')->references('id')->on('marcas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('art');
    }
};
