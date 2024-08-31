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
        Schema::create('tipo_sensors', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->decimal('max_val', 15, 2);
            $table->decimal('min_val', 15, 2);
            $table->string('unidad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_sensors');
    }
};
