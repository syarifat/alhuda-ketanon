<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('modul_aplikasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_modul', 100); // Contoh: "Kelola Berita"
            $table->string('kode_modul', 50)->unique(); // Contoh: "berita" (untuk pengecekan di kodingan)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('modul_aplikasi');
    }
};