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
            $table->string('nombre',50)->nullable('false');
            $table->unsignedTinyInteger('cat_id')->constrained()->nullable('false');
            $table->unsignedSmallInteger('marca_id')->constrained()->nullable('false');
            $table->mediumInteger('stock')->nullable('false');
            $table->decimal('precio', total: 8, places: 2)->nullable('false');
            $table->smallInteger('repo')->nullable('false');
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
