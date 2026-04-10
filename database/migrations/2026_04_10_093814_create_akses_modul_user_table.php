<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('akses_modul_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('modul_id')->constrained('modul_aplikasi')->onDelete('cascade');
            $table->timestamps();
            
            // Mencegah duplikasi data (1 user tidak boleh didaftarkan ke 1 modul yang sama 2 kali)
            $table->unique(['user_id', 'modul_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('akses_modul_user');
    }
};