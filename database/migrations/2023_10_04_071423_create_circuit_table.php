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
        Schema::create('circuit', function (Blueprint $table) {
            $table->id('id_circuit');
            $table->string('nom');
            $table->string('description');
            $table->integer('duree');
            $table->string('photo');
            $table->decimal('prix_estimatif', $scale = 2);
            $table->boolean('visible');
            $table->foreignId('id_categorie')->nullable()->references('id_categorie')->on('categorie')->on('categorie')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('circuit');
    }
};
