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
        Schema::create('mot_cle', function (Blueprint $table) {
            $table->id('id_mc');
            $table->foreignId('id_thematique')->references('id_thematique')->on('thematique')->on('thematique')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_circuit')->references('id_circuit')->on('circuit')->on('circuit')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mot_cle');
    }
};
