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
        Schema::create('lieu', function (Blueprint $table) {
            $table->id('id_lieu');
            $table->string('nom');
            $table->string('description');
            $table->string('pays');
            $table->string('photo');
            $table->string('continent');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lieu');
    }
};
