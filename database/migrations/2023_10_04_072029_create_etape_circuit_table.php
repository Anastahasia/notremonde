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
        Schema::create('etape_circuit', function (Blueprint $table) {
            $table->id('id_ec');
            $table->integer('jours');
            $table->foreignId('id_hebergement')->references('id_hebergement')->on('hebergement')->on('hebergement')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_circuit')->references('id_circuit')->on('circuit')->on('circuit')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etape_circuit');
    }
};
