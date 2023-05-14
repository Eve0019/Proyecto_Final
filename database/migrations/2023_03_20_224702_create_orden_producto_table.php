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
        Schema::create('orden_producto', function (Blueprint $table) {
            $table->id();
            $table->foreignId('orden_id')->constrained('ordenes')->onDelete('cascade');
            /* $table->foreignId('product_id')->constrained(); */
            /* $table->foreignId('product_id')->constrained()->onUpdate('cascade')->onDelete('cascade'); */
            $table->foreignId('producto_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('cantidad');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orden_producto');
    }
};
