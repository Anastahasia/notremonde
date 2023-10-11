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
        Schema::create('itineraire', function (Blueprint $table) {
            $table->id('id_itineraire');
            $table->string('nom');
            $table->string('description');
            $table->string('photo');
            $table->date('arrivee');
            $table->date('depart');
            $table->integer('voyageurs_adulte');
            $table->integer('voyageurs_enfants');
            $table->decimal('prix_total', $scale = 2);
            $table->foreignId('id_utilisateur')->nullable()->references('id_utilisateur')->on('utilisateur')->on('utilisateur')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itineraire');
    }
};
