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
        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->string('filename'); // nama file foto
            $table->string('path');     // lokasi penyimpanan foto
            $table->unsignedBigInteger('villa_id')->nullable(); // relasi ke tabel villas
            $table->timestamps();

            // relasi ke tabel villas
            $table->foreign('villa_id')->references('id')->on('villas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photos');
    }
};
