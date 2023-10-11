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
        Schema::create('etape_itineraire', function (Blueprint $table) {
            $table->id('id_ei');
            $table->date('arrivee');
            $table->date('depart');
            $table->foreignId('id_itineraire')->references('id_itineraire')->on('itineraire')->on('itineraire')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_hebergement')->references('id_hebergement')->on('hebergement')->on('hebergement')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etape_itineraire');
    }
};
