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
    Schema::create('centro_votacions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('municipio_id')->constrained('municipios')->onDelete('cascade');
        $table->string('nombre');
        $table->string('codigo')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('centro_votacions');
    }
};
