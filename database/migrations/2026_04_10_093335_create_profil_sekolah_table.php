<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profil_sekolah', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sekolah', 255);
            $table->string('logo', 255)->nullable()->comment('Path atau URL gambar logo');
            $table->text('visi')->nullable();
            $table->text('misi')->nullable()->comment('Bisa disimpan dengan format HTML list');
            $table->text('sejarah_singkat')->nullable();
            $table->string('nama_kepala_sekolah', 150)->nullable();
            $table->string('foto_kepala_sekolah', 255)->nullable()->comment('Path atau URL foto');
            $table->text('sambutan_kepala_sekolah')->nullable();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profil_sekolah');
    }
};