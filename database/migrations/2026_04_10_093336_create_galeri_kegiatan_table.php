<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galeri_kegiatan', function (Blueprint $table) {
            $table->id();
            $table->string('judul_kegiatan', 255);
            $table->string('media_path', 255)->comment('Path gambar atau Link YouTube');
            $table->string('deskripsi_singkat', 500)->nullable();
            $table->date('tanggal_kegiatan');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galeri_kegiatan');
    }
};