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
        Schema::create('hebergement', function (Blueprint $table) {
            $table->id('id_hebergement');
            $table->string('nom');
            $table->string('description');
            $table->string('photo1');
            $table->string('photo2');
            $table->string('type');
            $table->string('adresse');
            $table->string('telephone');
            $table->foreignId('id_lieu')->nullable()->references('id_lieu')->on('lieu')->on('lieu')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hebergement');
    }
};
