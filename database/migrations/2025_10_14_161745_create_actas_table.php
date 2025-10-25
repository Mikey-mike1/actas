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
    Schema::create('actas', function (Blueprint $table) {
        $table->id();
        $table->foreignId('municipio_id')->constrained();
        $table->foreignId('centro_votacion_id')->constrained();
        $table->string('jrv');
        $table->string('pdf_path')->nullable(); // para guardar el PDF
        $table->text('observaciones')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actas');
    }
};
