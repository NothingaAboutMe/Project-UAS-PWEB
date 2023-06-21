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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mobil');
            $table->string('slug');
            $table->string('harga_sewa');
            $table->string('gambar');
            $table->string('bahan_bakar');
            $table->string('jumlah_kursi');
            $table->string('transmisi');
            $table->string('status');
            $table->string('deskripsi');
            $table->string('p3k');
            $table->string('charger');
            $table->string('audio');
            $table->string('ac');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
