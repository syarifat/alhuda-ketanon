<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('username', 100)->unique();
            $table->string('password');
            $table->enum('role', ['superadmin', 'admin'])->default('admin');
            $table->rememberToken();
            $table->timestamps();
        });

        // Tabel bawaan Laravel untuk reset password dan session bisa opsional dibuat atau dihapus
        // Jika tidak butuh fitur "Lupa Password via Email", tabel password_reset_tokens bisa dilewati.
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};