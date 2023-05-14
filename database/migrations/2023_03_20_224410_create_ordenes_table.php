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
        Schema::create('ordenes', function (Blueprint $table) {
            $table->id();
            $table->string('tipo',25)->nullable(); //Recoger en Casa o Tienda
            $table->string('direccion',100)->nullable();
            $table->date('fecha')->nullable(); //Fecha estimada entrega
            $table->string('estado',25); //Si ya tienen el producto o no
            $table->float('total');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordenes');
    }
};
